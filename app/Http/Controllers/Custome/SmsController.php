<?php
namespace App\Http\Controllers\Custome;
//namespace App\Http\Controllers\home;
 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
// 引入阿里大鱼命名空间
use iscms\Alisms\SendsmsPusher as Sms;
use Session;
use DB;
use App\Model\User;
class SmsController extends Controller
{
	protected  $sms;
	public function __construct(Sms $sms)
	{
		$this->sms=$sms;
	}
	/*
	 * 注册发送短信  手机号验证放在中间件
	 * phone
	 */
	public function SmsRegister(Request $request){
	    //判断当前手机号是否在数据库
	    $code = $request -> input ('code');
	    $phone = $request -> input ('mobile');
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
	        $name = 'GSM玩机网';
	        $code = 'SMS_59950404'; // 短信模板id
	       // $sendsms = new Sms();json_encode(['salename'=>COMREGSALENAME,'username'=>$userName]),
	        //$vcode =json_encode(['number'=>"$vcode"]);
	        $res = $this->sms->send($phone, $name,json_encode(['number'=>"$vcode"]), $code);
	        if($res){
	            Session::flash('mescode', $vcode);
	            Session::flash('phone', $phone);
	        }else{
	            //是不是得加一个日志
	            
	            Session::flash($phone, time());
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
	public function SmsFindPwd(Request $request)
	{
		$mobile = $request -> input ('mobile');
		$userInfo = User::where('Mobile',$mobile)->first();
		if(empty($userInfo)){
			return response()->json(['code'=>'F','msg'=>'该账号不存在！']);
		}
		//判断当前用户是否之前发送过短信
		$phone = $userInfo ['Mobile'];
		$lastTime = 0;
		if(session::has($phone)){
			$lastTime = Session::get($phone);
		}
		
		if((time()-$lastTime) > 300){
			//发送短信
			$vcode = rand(100000,999999);
			$name = 'GSM玩机网';
	       		$code = 'SMS_59950404'; // 短信模板id
			$res = $this->sms->send($phone, $name, json_encode(array('number'=>"$vcode")), $code);
			if($res){
				Session::flash('resetcode', $vcode);
				return response()->json(['code'=>'S','msg'=>'短信发送成功！']);
			}else{
				return response()->json(['code'=>'S','msg'>'短信发送失败！']);
			}
		}
		//不发送短信  直接提示发送成功
		return response()->json(['code'=>'S','msg'=>'短信发送成功！']);
		
	}
	
}
