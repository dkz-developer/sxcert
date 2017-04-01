<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\InfoCommon;

class InfoController extends Controller
{
	public function addInfo()
	{
		return view('admin.addInfo');
	}

	public function infoList()
	{
		return view('admin.infoList');
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
