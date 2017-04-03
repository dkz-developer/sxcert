<?php

namespace App\Http\Controllers\home;
 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
// 引入阿里大鱼命名空间
use iscms\Alisms\SendsmsPusher as Sms;
use Session;
use DB;
class Sms extends Controller
{
    protected  $sms;
    public function __construct(Sms $sms)
    {
        $this->Sms = $sms;
    }
	/*
	 * 注册发送短信  手机号验证放在中间件
	 * phone
	 */
	public function SmsRegister(Request $request){
	    //判断当前手机号是否在数据库
	    $phone = $request -> input ('phone');
	    $count = User::where('Mobile',$phone)->count();
	    if($count){
	        return response()->json(['code'=>'F','msg'=>'该手机号已经被注册了']);
	    }
	    $lastTime = 0;
	    //判断当前用户是否之前发送过短信
	    if(session::has($phone)){
	        $lastTime = Session::get($phone);
	    }
	    
	    if((time()-$lastTime) > 300){
	        //发送短信
	        $vcode = rand(100000,999999);
	        $name = '注册验证';
	        $code = 'SMS_3166316'; // 短信模板id
	        $res = $this->sms->send($phone, $name, array('vcode'=>$vcode), $code);
	        if($res){
	            Session::flash('vcode', $vcode);
	        }else{
	            return response()->json(['code'=>'S','msg'=>'短信发送失败']);
	        }
	    }
        //不发送短信  直接提示发送成功
        return response()->json(['code'=>'S','msg'=>'短信发送成功']);
	    
	}
	
	/*
	 * 密码找回
	 * 
	 */
	public function SmsFindPwd(Request $request){
	    $username = $request -> input ('username');
	    $userInfo = User::where(['UserName',$username])->first();
	    if(!$userInfo || !$userInfo ['Mobile']){
	        return response()->json(['code'=>'F','msg'=>'用户名有误']);
	    }
	    //判断当前用户是否之前发送过短信
	    $phone = $userInfo ['Mobile'];
	    if(session::has($phone)){
	        $lastTime = Session::get($phone);
	    }
	    
	    if((time()-$lastTime) > 300){
	        //发送短信
	        $vcode = rand(100000,999999);
	        $name = '密码找回';
	        $code = 'SMS_3166316'; // 短信模板id
	        $res = $this->sms->send($phone, $name, array('vcode'=>$vcode), $code);
	        if($res){
	            Session::flash('resetcode', $vcode);
	        }else{
	            return response()->json(['code'=>'S','msg'>'短信发送失败']);
	        }
	    }
	    //不发送短信  直接提示发送成功
	    return response()->json(['code'=>'S','msg'=>'短信发送成功']);
	    
	}
	
}
