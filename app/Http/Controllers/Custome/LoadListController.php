<?php

namespace App\Http\Controllers\Custome;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Info;

use Session;
use DB;
class LoadListController extends Controller
{
	public function index()
	{
	    $list = Info::where('status','2'  )->orderBy('sort' , 'desc')->lists('tag','brand','country','model','version','os','type','price','updated_at','view_num','download_num','download_url');
		
	}

    /*
     * 搜索列表
     */
	public function loadlist(Request $request)
	{
	    $page = $request->input('page' , 1);
	    $limit = 20;
	    $skip = ($page -1)*$limit ;
		$version = $request->input('version');
		$model = $request->input('model');
		
		
		if(empty($version) && empty($model)){
		   //$list = Info::where('status','2')->orderBy('sort' , 'desc')->lists('id','tag','brand','country','model','version','os','type','price','updated_at','view_num','download_num','download_url');
		   $list = Info::where('status','2')->orderBy('sort' , 'desc')->get();
		   
		}else{
		    $list = Info::where('model',$model)->orWhere('version',$version)->orderBy('updated_at' , 'desc')->skip($skip)->take($limit)->get();
		}
		
		
		if($list){
		    return response()->json(['code'=>'S','msg'=>$list]);
		}else{
		    return response()->json(['code'=>'F','msg'=>'没查询到']);
		}
	}


	/*
	 * 详情页
	 * 
	 */
	public function detail(Request $request){
	    $id = $request->input('id');
	    if(empty($id)){
	        return response()->json(['code'=>'F','msg'=>'没查询到']);
	    }
	    $info = Info::where(['id',$id])->first();
	    if(empty($info)){
	        return response()->json(['code'=>'F','msg'=>'没查询到']);
	    }
	    Info::where(['id',$id])->update('view_num',`view_num`+1);
	    
	    return  response()->json(['code'=>'S','msg'=>$info]);
	    
	}
	
	
}
