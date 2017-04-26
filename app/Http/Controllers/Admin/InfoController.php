<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\InfoCommon;
use App\Model\admin\Info;
use App\Model\InfoUser;

class InfoController extends Controller
{
	public function toExamine(Request $request)
	{
		$id = $request->input('ids',0);
		$status = $request->input('status',false);
		if(! $id || ! $status)
			return response()->json(['code'=>'F','msg'=>'参数错误！']);
		$InfoUser = InfoUser::find($id);
		if( 3 == $status ) {
			$InfoUser->status = 3;
			$result = $InfoUser->save();
			if($result) 
				return response()->json(['code'=>'S','msg'=>'操作成功！']);
			return response()->json(['code'=>'F','msg'=>'操作失败！']);
		}
		if( 2 == $status ) {
			$Info = new Info();
			$data['brand'] = $InfoUser->brand;
			$data['model'] = $InfoUser->model;
			$data['country'] = $InfoUser->country;
			$data['os'] = $InfoUser->os;
			$data['version'] = $InfoUser->version;
			$data['download_url'] = $InfoUser->download_url;
			$data['download_password']= $InfoUser->download_password;
			$data['status']= 1;
			$data['uinfo_id'] = $InfoUser->id;
			$data['price'] = $InfoUser->price;
			$data ['type'] = $InfoUser->type;
			$data ['created_at'] = $InfoUser->created_at;
			$data ['updated_at'] = $InfoUser->updated_at;
			$result = $Info->insertGetId($data);
			if($result)  {
				$InfoUser->status = 2;
				$InfoUser->info_id = $result;
				$InfoUser->save();
				return response()->json(['code'=>'S','msg'=>'操作成功！']);
			}
			return response()->json(['code'=>'F','msg'=>'操作失败！']);
		}
		return response()->json(['code'=>'F','msg'=>'参数错误！']);
	}

	public function setHot(Request $request)
	{
		$id = $request->input('id');
		$Model = Info::find($id);
		if(1 == $Model->status)
			$Model->status = 2;
		else if(2 == $Model->status)
			$Model->status = 1;
		$result = $Model->save();
		if($result && $Model->status == 2)
			return response()->json(['code'=>'F','msg'=>'操作成功 !','data'=>'<i class="Hui-iconfont">&#xe65e;</i>']);
		if($result && $Model->status == 1)
			return response()->json(['code'=>'F','msg'=>'操作成功 !','data'=>'<i class="Hui-iconfont">&#xe688;</i>']);
		else
			return response()->json(['code'=>'F','msg'=>'操作失败']);
	}

	public function userInfo()
	{
		$InfoUser = new InfoUser();
		$list = $InfoUser->where('status',1)->orderBy('created_at','desc')->paginate(15);
		$rows = $InfoUser->where('status',1)->count();
		return view('admin.userInfo',['list'=>$list,'rows'=>$rows]);
	}

	public function addInfo(Request $request)
	{
		$Model = new InfoCommon();
		$brand = $Model->where('type',1)->get();
		$model = $Model->where('type',2)->get();
		$country = $Model->where('type',3)->get();
		$os = $Model->where('type',4)->get();
		$type = $Model->where('type',5)->get();
		$tag = $Model->where('type',6)->get();
		$id = $request->input('id','');
		$result = [
			'brand'=>$brand,
			'model'=>$model,
			'country'=>$country,
			'os'=>$os,
			'type'=>$type,
			'tag'=>$tag,
		];
		if($id) {
			$info = Info::where('id',$id)->first();
			$result ['info'] = $info;
		}
		return view('admin.addInfo',$result);
	}

	public  function rmInfo(Request $request)
	{
		$ids = $request->input('ids','');
		$ids = explode(',', $ids);
		if(empty($ids))
			return response()->json(['code'=>'F','msg'=>'参数错误！']);
		$result = Info::whereIn('id',$ids)->delete();
		if($result)
			return response()->json(['code'=>'S','msg'=>'删除成功！']);
		return response()->json(['code'=>'F','msg'=>'删除失败！']);
	}

	public function addInfoHandle(Request $request)
	{
		if($request->has('id')) {
			$Model = Info::find($request->input('id'));
		}else {
			$Model = new Info();
		}
		$Model->brand = $request->input('brand','');
		$Model->model = $request->input('model','');
		$Model->os = $request->input('os','');
		$Model->type = $request->input('type','');
		//$Model->tag = $request->input('tag','');
		$Model->price = $request->input('price',0);
		$Model->remarks = $request->input('remarks','');
		$Model->country = $request->input('country','');
		$Model->download_url = $request->input('download_url','');
		$Model->download_password = $request->input('download_password','');
		$Model->sort = $request->input('sort','');
		$Model->version = $request->input('version','');
		//$Model->cover = $request->input('cover','');
		$Model->abstract = $request->input('editorValue','');
		$result = $Model->save();
		if($result)
			return response()->json(['code'=>'S','msg'=>'操作成功！']);
		return response()->json(['code'=>'F','msg'=>'操作失败！']);
	}

	public function fileUpload(Request $request)
	{
		$path = $request->file('file')->store('public');
		return response()->json(['path'=>$path]);
	}	

	public function infoList(Request $request)
	{
		$stime = $request->input('start_time','');
		$etime = $request->input('end_time','');
		$index = $request->input('index','');
		$keyword = $request->input('keyword','');
		$indexArr = [1=>'id','brand','model','country','os','type','tag','version'];
		$where = [];
		if(! empty($stime))
			array_push($where, ['updated_at','>=',$stime]);
		if(! empty($etime))
			array_push($where, ['updated_at','<=',$etime]);
		if(! empty($index) && ! empty($index) && ! empty($keyword))
			array_push($where, [$indexArr [$index],'=',$keyword]);
		$result = Info::where($where)->orderBy('created_at','desc')->paginate(15);
		$rows = Info::where($where)->count();
		return view('admin.infoList',['list'=>$result,'rows'=>$rows]);
	}

	public function common(Request $request)
	{
		$Model = new InfoCommon();
		$brand = $Model->where('type',1)->orderBy('created_at','desc')->paginate(10,['*'],'bpage');
		$brandCount = $Model->where('type',1)->count();
		$model = $Model->where('type',2)->orderBy('created_at','desc')->paginate(10,['*'],'mpage');
		$modelCount = $Model->where('type',2)->count();
		$country = $Model->where('type',3)->orderBy('created_at','desc')->paginate(10,['*'],'cpage');
		$countryCount = $Model->where('type',3)->count();
		$os = $Model->where('type',4)->orderBy('created_at','desc')->paginate(10,['*'],'lpage');
		$osCount = $Model->where('type',4)->count();
		$type = $Model->where('type',5)->orderBy('created_at','desc')->paginate(10,['*'],'tpage');
		$typeCount = $Model->where('type',5)->count();
		$tag = $Model->where('type',6)->orderBy('created_at','desc')->paginate(10,['*'],'gpage');
		$tagCount = $Model->where('type',6)->count();
		$result = [
			'brand'=>$brand,
			'brandCount'=>$brandCount,
			'model'=>$model,
			'modelCount'=>$modelCount,
			'country'=>$country,
			'countryCount'=>$countryCount,
			'os'=>$os,
			'osCount'=>$osCount,
			'type'=>$type,
			'tag'=>$tag,
			'typeCount'=>$typeCount,
			'tagCount'=>$tagCount
		];
		return view('admin.common',$result);
	}

	public function commonAdd(Request $request)
	{
		$type = $request->input('type');	
		$name = $request->input('name');
		if(! $type || ! $name) 
			return response()->json(['code'=>'F','msg'=>'参数错误']);
		$Model = new InfoCommon();
		$Model->type = intval($type);
		$Model->name = $name;
		$result = $Model->save();
		if($result)
			return response()->json(['code'=>'S','msg'=>'添加成功']);
		return response()->json(['code'=>'F','msg'=>'添加失败']);
	}
	
	public function commonDelete(Request $request) 
	{
	    $type = $request->input('type');
	    $id = $request->input('id');
	    
	    if(! $type || ! $id)
	        return response()->json(['code'=>'F','msg'=>'参数错误']);
	    
	    $Model = new InfoCommon();
	    
	    $result = $Model->where('type',$type)->where('id',$id)->delete();
	    if($result)
	        return response()->json(['code'=>'S','msg'=>'操作成功']);
	    return response()->json(['code'=>'F','msg'=>'操作失败']);
	}

}
