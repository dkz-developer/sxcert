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
use Naux\Mail\SendCloudTemplate;
use Illuminate\Support\Facades\Mail;
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

		$email = $request->input('mobile');
		$count = User::where('UserEmail',$email)->count();
		if($count)
			return response()->json(['code'=>'F','msg'=>'该邮箱以及被注册!']);
		if(session('last_send_time'.$email)) 
		{
			if(time() - session('last_send_time'.$email) < 60)
				return response()->json(['code'=>'F','msg'=>'发送过于频繁,请稍后!']);
		}
		$active_code = mt_rand(100000,999999);
		session(['active_code_'.$email=>$active_code]);
		$template = new SendCloudTemplate('test_template', ['name'=>'亲爱的gsmgood用户','active_code'=>$active_code]);
		Mail::raw($template, function ($message) use($email) {
		            $message->from('service@admin.gsmgood.com', 'gsmgood');
		            $message->to($email);
		});
		session(['last_send_time'.$email=>time()]);
		return response()->json(['code'=>'S','msg'=>'邮箱验证码发送成功!']);
	}
	
	/*
	 * 密码找回
	 * 
	 */
	public function SmsFindPwd(Request $request)
	{
		$email = $request->input('mobile');
		$count = User::where('UserEmail',$email)->count();
		if(!$count)
			return response()->json(['code'=>'F','msg'=>'该用户不存在!']);
		if(session('last_send_time_f'.$email)) 
		{
			if(time() - session('last_send_time_f'.$email) < 60)
				return response()->json(['code'=>'F','msg'=>'发送过于频繁,请稍后!']);
		}
		$active_code = mt_rand(100000,999999);
		session(['active_code_f'.$email=>$active_code]);
		$template = new SendCloudTemplate('test_template', ['name'=>'亲爱的gsmgood用户','active_code'=>$active_code]);
		Mail::raw($template, function ($message) use($email) {
		            $message->from('service@admin.gsmgood.com', 'gsmgood');
		            $message->to($email);
		});
		session(['last_send_time_f'.$email=>time()]);
		return response()->json(['code'=>'S','msg'=>'邮箱验证码发送成功!']);

		/*$mobile = $request -> input ('mobile');
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
		
		//if((time()-$lastTime) > 300){
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
			}*/
		//}
		//不发送短信  直接提示发送成功
		//return response()->json(['code'=>'S','msg'=>'短信发送成功！']);
		
	}
	
}
