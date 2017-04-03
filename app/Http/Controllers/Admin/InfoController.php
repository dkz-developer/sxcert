<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\InfoCommon;
use App\Model\admin\Info;

class InfoController extends Controller
{
	public function addInfo()
	{
		$Model = new InfoCommon();
		$brand = $Model->where('type',1)->get();
		$model = $Model->where('type',2)->get();
		$country = $Model->where('type',3)->get();
		$os = $Model->where('type',4)->get();
		$type = $Model->where('type',5)->get();
		$tag = $Model->where('type',6)->get();
		$result = [
			'brand'=>$brand,
			'model'=>$model,
			'country'=>$country,
			'os'=>$os,
			'type'=>$type,
			'tag'=>$tag,
		];
		return view('admin.addInfo',$result);
	}

	public function addInfoHandle(Request $request)
	{
		$Model = new Info();
		$Model->brand = $request->input('brand','');
		$Model->model = $request->input('model','');
		$Model->os = $request->input('os','');
		$Model->type = $request->input('type','');
		$Model->tag = $request->input('tag','');
		$Model->price = $request->input('price',0);
		$Model->remarks = $request->input('remarks','');
		$Model->country = $request->input('country','');
		$Model->download_url = $request->input('download_url','');
		$Model->download_password = $request->input('download_password','');
		$Model->sort = $request->input('sort','');
		$Model->version = $request->input('version','');
		$Model->cover = $request->input('cover','');
		$Model->abstract = $request->input('abstract','');
		$result = $Model->save();
		if($result)
			return response()->json(['code'=>'S','msg'=>'添加成功！']);
		return response()->json(['code'=>'F','msg'=>'添加失败！']);
	}

	public function fileUpload(Request $request)
	{
		$path = $request->file('file')->store('avatars');
		return response()->json(['path'=>$path]);
	}	

	public function infoList()
	{
		$result = Info::paginate(15);
		return view('admin.infoList',['list'=>$result]);
	}

	public function common()
	{
		$Model = new InfoCommon();
		$brand = $Model->where('type',1)->paginate(10);
		$brandCount = $Model->where('type',1)->count();
		$model = $Model->where('type',2)->paginate(10);
		$modelCount = $Model->where('type',2)->count();
		$country = $Model->where('type',3)->paginate(10);
		$countryCount = $Model->where('type',3)->count();
		$os = $Model->where('type',4)->paginate(10);
		$osCount = $Model->where('type',4)->count();
		$type = $Model->where('type',5)->paginate(10);
		$typeCount = $Model->where('type',5)->count();
		$tag = $Model->where('type',6)->paginate(10);
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
}
