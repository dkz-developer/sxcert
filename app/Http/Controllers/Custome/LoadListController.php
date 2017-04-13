<?php

namespace App\Http\Controllers\Custome;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Info;
use App\Model\InfoComment;
use App\Model\User;
use App\Model\BuyRecord;
use Session;
use DB;
class LoadListController extends Controller
{
	public function download(Request $request)
	{
		if( empty(session('userInfo')) ) 
			return response()->json(['code'=>'F','msg'=>'','url'=>'/enter?type=login']);
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

	public function detail(Request $request)
	{
		$id = $request->input('keyword','');
		$result = Info::find(intval($id));
		$result->view_num += 1;
		$result->save();
		$infoComment = InfoComment::where('info_id',$id)->get();
		return view('info',['info'=>$result,'infoComment'=>$infoComment]);
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

	public function index()
	{
		$list = Info::where('status','2'  )->orderBy('sort' , 'desc')->lists('tag','brand','country','model','version','os','type','price','updated_at','view_num','download_num','download_url');
		
	}

	/*
	 * 搜索列表
	 * $keyword 型号或者机型
	 */
	public function loadlist(Request $request)
	{
		$page = $request->input('page' , 1);
		$total = 1;
		$limit = 20;
		$skip = ($page -1)*$limit ;
		$keyword = $request->input('keyword',false);
		$brand = $request->input('brand',false);
		$model = $request->input('model',false);
		$country = $request->input('country',false);
		$version = $request->input('version',false);
		$tag = $request->input('tag',false);
		$type = $request->input('type',false);
		
		if($brand){
			$condition ['brand'] = $brand;
		}
		if($model){
			$condition ['model'] = $model;
		}
		if($country){
			$condition ['country'] = $country;
		}
		if($version){
			$condition ['version'] = $version;
		}
		if($tag){
			$condition ['tag'] = $tag;
		}
		if($type){
			$condition ['type'] = $type;
		}
		
		
		if( $keyword){
			$list = Info::where('model',$keyword)->orWhere('version',$keyword)->orderBy('updated_at' , 'desc')->skip($skip)->take($limit)->get();
			$count = Info::where('model',$keyword)->orWhere('version',$keyword)->count();
			$total = ceil($count/$limit) ;
		   
		   
		}elseif(isset($condition)){
			$list = Info::where($condition)->orderBy('updated_at' , 'desc')->skip($skip)->take($limit)->get();
			$count = Info::where($condition)->count();
			$total = ceil($count/$limit) ;
		}else{
			//$list = Info::where('status','2')->orderBy('sort' , 'desc')->lists('id','tag','brand','country','model','version','os','type','price','updated_at','view_num','download_num','download_url');
			$list = Info::where('status','2')->orderBy('sort' , 'desc')->get();
		}
		
		
		if($list){
			return response()->json(['code'=>'S','msg'=>$list,'page'=>$page,'total'=>$total ]);
		}else{
			return response()->json(['code'=>'F','msg'=>'没查询到']);
		}
	}
}
