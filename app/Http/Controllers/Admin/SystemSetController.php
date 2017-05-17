<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class SystemSetController extends Controller
{
	public function base()
	{
		$result = DB::table('SystemSet')->get();
		return view('admin.base',['list'=>$result]);
	}

	public function changeSeo(Request $request)
	{
		$id = $request->input('id');
		$content = $request->input('content');
		if(! is_numeric($id) || empty($content)) {
			return response()->json(['code'=>'F','msg'=>'参数错误！']);
		}

		$result = DB::table('SystemSet')->where('id',$id)->update(['content'=>$content]);
		if($result)
			return response()->json(['code'=>'S','msg'=>'修改成功！']);
		return response()->json(['code'=>'F','msg'=>'操作失败！']);
	}
}