<?php

namespace App\Http\Controllers\Custome;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Info;
use App\Model\InfoComment;
use App\Model\admin\InfoCommon;
use App\Model\User;
use App\Model\BuyRecord;
use Session;
use DB;
use App\Model\InfoUser;
class LoadListController extends Controller
{
	protected $seoTitle;
	protected$search;
	protected $keyword;
	public function __construct()
	{
		$this->seoTitle = DB::table('SystemSet')->find(1);
		$this->search = DB::table('SystemSet')->find(2);
		$this->keyword = DB::table('SystemSet')->find(3);
	}
	public function pay()
	{
		return view('pay',['search'=>$this->search,'keyword'=>$this->keyword]);
	}
	public function service()
	{
		return view('service',['search'=>$this->search,'keyword'=>$this->keyword]);
	}
	public function userRom(Request $request)
	{
		$type = $request->input('type',0);
		$keyword = $request->input('keyword',false);
		$Common = new InfoCommon();
		if($type && $keyword) {
			$list = $Common->where([['type',$type],['name','like',"%{$keyword}%"]])->get();
			return response()->json(['code'=>'S','msg'=>'操作成功','rows'=>$list]);
		}
		$brand = $Common->where('type',1)->get();
		$model = $Common->where('type',2)->get();
		$country = $Common->where('type',3)->get();
		$os = $Common->where('type',4)->get();
		$type = $Common->where('type',5)->get();
		return view('rom',['brand'=>$brand,'model'=>$model,'country'=>$country,'os'=>$os,'type'=>$type]);
	}

	public function userRomAdd(Request $request)
	{
		if(empty(session('userInfo')))
			return response()->json(['code'=>'F','msg'=>'请先登录！','url'=>'/login']);
		$InfoUser = new InfoUser();
		$InfoUser->brand = $request->brand;
		$InfoUser->model = $request->model;
		$InfoUser->country = $request->country;
		$InfoUser->os = $request->os;
		$InfoUser->type = $request->type;
		$InfoUser->version = $request->version;
		$InfoUser->price = $request->price;
		$InfoUser->download_password = $request->download_password;
		$InfoUser->download_url = $request->download_url;
		$InfoUser->user_id = session('userInfo.UserId');
		$result = $InfoUser->save();
		if($result)
			return response()->json(['code'=>'S','添加成功！等待管理员审核']);
		return response()->json(['code'=>'F','添加失败！']);
	}

	public function download(Request $request)
	{
		if( empty(session('userInfo')) ) 
			return response()->json(['code'=>'F','msg'=>'','url'=>'/login']);
		$id = $request->input('info_id');
		if(! is_numeric($id))
			return response()->json(['code'=>'F','msg'=>'参数错误']);
		$userInfo = User::find(session('userInfo.UserId'));
		$info = Info::find($id);
		$record= BuyRecord::where([['user_id',session('userInfo.UserId')],['info_id',$id]])->first();
		if(! empty($record))
			return response()->json(['code'=>'S','msg'=>'','url'=>$info->download_url,'new_open'=>true]);
		if($userInfo->Balance < $info->price)
			return response()->json(['code'=>'F','msg'=>'余额不足，请先充值！','url'=>'/pay']);
		DB::beginTransaction();
		$info->download_num += 1;
		$i_result = $info->save();
		if(!empty($info->uinfo_id)) {
			$InfoUser = InfoUser::find($info->uinfo_id);
			$InfoUser->download_num += 1;
			$InfoUser->save();
			// $User = User::find($InfoUser->user_id);
			// $amount = $info->price * 0.01;
			// $User->Balance += $amount;
			// $result = $User->save();
		}
		$userInfo->Balance -= $info->price;
		$u_result = $userInfo->save();
		$BuyRecord = new BuyRecord();
		$BuyRecord->user_id = session('userInfo.UserId');
		$BuyRecord->info_id = $id;
		$BuyRecord->consume = $info->price;
		$b_result = $BuyRecord->save();
		if($b_result && $u_result && $i_result){
			DB::commit();
			return response()->json(['code'=>'S','msg'=>'','url'=>$info->download_url,'new_open'=>true]);
		}
		DB::rollBack();
		return response()->json(['code'=>'F','msg'=>'操作失败！']);
	}

	public function detail(Request $request,$id)
	{
		//$id = $request->input('keyword','');
		$result = Info::find(intval($id));
		if(empty($result))
			return redirect('/');
		$result->view_num += 1;
		$result->save();
		if(!empty($result->uinfo_id)) {
			$InfoUser = InfoUser::find($result->uinfo_id);
			$InfoUser->view_num += 1;
			$InfoUser->save();
		}
		$infoComment = InfoComment::where('info_id',$id)->get();

		return view('info',['info'=>$result,'infoComment'=>$infoComment,'search'=>$this->search,'keyword'=>$this->keyword]);
	}

	public function addInfoComment(Request $request)
	{
		if( empty(session('userInfo')) ) 
			return response()->json(['code'=>'F','msg'=>'请先登录！']);
		$content = $request->input('content');
		$info_id = $request->input('info_id');
		if(! $content || ! $info_id) 
			return response()->json(['code'=>'F','msg'=>'参数错误！']);
		$InfoComment = new InfoComment();
		$InfoComment->user_id = session('userInfo.UserId');
		$InfoComment->info_id = $info_id;
		$InfoComment->content = $content;
		$InfoComment->user_name = session('userInfo.UserName');
		$result = $InfoComment->save();
		if($result)
			return  response()->json(['code'=>'S','msg'=>'操作成功！','data'=>$InfoComment]);
		return  response()->json(['code'=>'F','msg'=>'操作失败！']);
	}

	public function searchBrand(Request $request)
	{
		$keyword = $request->input('k');
		$list = $this->_search($keyword,1);
		return view('search',['list'=>$list,'search'=>$this->search,'keyword'=>$this->keyword]);
	}

	public function searchCountry(Request $request)
	{
		$keyword = $request->input('k');
		$list = $this->_search($keyword,2);
		return view('search',['list'=>$list,'search'=>$this->search,'keyword'=>$this->keyword]);
	}

	public function searchModel(Request $request)
	{
		$keyword = $request->input('k');
		$list = $this->_search($keyword,3);
		return view('search',['list'=>$list,'search'=>$this->search,'keyword'=>$this->keyword]);
	}

	public function searchVersion(Request $request)
	{
		$keyword = $request->input('k');
		$list = $this->_search($keyword,4);
		return view('search',['list'=>$list,'search'=>$this->search,'keyword'=>$this->keyword]);
	}

	public function searchOs(Request $request)
	{
		$keyword = $request->input('k');
		$list = $this->_search($keyword,5);
		return view('search',['list'=>$list,'search'=>$this->search,'keyword'=>$this->keyword]);
	}

	public function searchType(Request $request)
	{
		$keyword = $request->input('k');
		$list = $this->_search($keyword,6);
		return view('search',['list'=>$list,'search'=>$this->search,'keyword'=>$this->keyword]);
	}

	public function searchKeyword(Request $request)
	{
		$keyword = $request->input('k');
		$list = $this->_search($keyword,7);
		return view('search',['list'=>$list,'search'=>$this->search,'keyword'=>$this->keyword]);
	}

	// public function getAllList()
	// {
	// 	$allList = Info::simplePaginate(20);
	// 	return view('search',['list'=>$allList,'act'=>'x']);
	// }

	private function _search($keyword,$index)
	{
		/*$keyword = $request->input('k',false);
		$index = (int)substr($keyword, -1);
		$keyword = substr($keyword, 0,-1);*/
		$arr = [1=>'brand','country','model','version','os','type'];
		$where = [];
		if($index==7) {
			$list = Info::where('model','like',"%{$keyword}%")->orWhere('version','like',"%{$keyword}%")->orderBy('created_at','desc')->simplePaginate(20);
		}else {
			$list = Info::where($arr[$index],'like',"%{$keyword}%")->orderBy('created_at','desc')->simplePaginate(20);
		}
		return $list;
		//return view('search',['list'=>$list]);
	}

	/*
	 * 搜索列表
	 * $keyword 型号或者机型
	 */
	public function loadlist(Request $request)
	{
		$Info = new Info();
		$list = $Info->where('status',2)->orderBy('created_at' , 'desc')->simplePaginate(20);
		
		return view('load',['list'=>$list,'seoTitle'=>$this->seoTitle,'search'=>$this->search,'keyword'=>$this->keyword]);
	}
}
