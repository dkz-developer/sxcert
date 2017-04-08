<?php

namespace App\Http\Controllers\Custome;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
//引用对应的命名空间
use Gregwar\Captcha\CaptchaBuilder;
use Session;
use DB;
class UserController extends Controller
{
	/**
	 * [userCenter 用户中心]
	 * @return [type] [description]
	 */
	public function userCenter(Request $request)
	{
		if(empty(session('userInfo')))
			return redirect('/enter?type=login');
		$userInfo = User::find(session('userInfo.UserId'));
		if(empty($userInfo))
			return redirect('/enter?type=register');
		return view('users',['userInfo'=>$userInfo]);
	}

	public function index()
	{
		
		return view('index');
	}


	public function login(Request $request)
	{
		$captcha = $request->input('code');
		if (Session::get('milkcaptcha') != $captcha) 
			return response()->json(['code'=>'F','msg'=>'验证码错误']);
		$userName = $request->input('username');
		$password = $request->input('password');
		$userInfo = User::where([['UserName',$userName],['Password',md5($password)]])->first();
		
		if(! $userInfo)
			return response()->json(['code'=>'F','msg'=>'用户名或密码不正确']);
		unset($userInfo ['Password']);
		session(['userInfo'=>$userInfo->toArray()]);
		return response()->json(['code'=>'S','msg'=>'登录成功']);
	}

	public function logout(Request $request)
	{
		$request->session()->flush();
		return redirect('/');
	}

	// 验证码
	public function captcha($tmp)
	{
		//生成验证码图片的Builder对象，配置相应属性
		$builder = new CaptchaBuilder;
		//可以设置图片宽高及字体
		$builder->build($width = 100, $height = 40, $font = null);
		//获取验证码的内容
		$phrase = $builder->getPhrase();
		//把内容存入session
		Session::flash('milkcaptcha', $phrase);
		//生成图片
		header("Cache-Control: no-cache, must-revalidate");
		header('Content-Type: image/jpeg');
		$builder->output();
	}
	
	
	//注册
	public function register(Request $request){
	    $vcode = $request->input('mescode');
	    if ((Session::get('mescode') != $vcode) || empty($vcode)){
	       return response()->json(['code'=>'F','msg'=>'验证码错咯']);
	    }
	        
	    $phone = $request->input('mobile');
	    if((Session::get('phone') != $phone) || empty($phone)){
	        return response()->json(['code'=>'F','msg'=>'手机号与验证手机号不一致呀']);
	    }	    
	    $username = $request->input('username');
	    $password = $request->input('password');
	    $repassword = $request->input('repassword');
	    $userInfo = User::where('UserName',$username)->first();
	    
	    if($password != $repassword){
	        return response()->json(['code'=>'F','msg'=>'两次密码不一致哦']);
	    }
	    
	    if($userInfo){
	        return response()->json(['code'=>'F','msg'=>'用户名已存在，换一个试试呗']);
	    }
	    $data = array(
	        'Mobile' => $phone,
	        'UserName' => $username,
	        'Password' => md5($password),
	        'CreateTime' => date('Y-m-d H:i:s'),
	    );
	    
	    
	    $res = User::insert($data);
	    if($res){
	        //session(['userInfo'=>$userInfo->toArray()]);
	        return response()->json(['code'=>'S','msg'=>'注册成功','url'=>'/index']);
	    }else{
	        return response()->json(['code'=>'F','msg'=>'注册失败']);
	    }
	}
	
	//修改密码
	public function restpwd(Request $request){
		$username = $request -> input ('username');
		if (Session::get('userInfo.UserName') != $username){  
			return response()->json(['code'=>'F','msg'=>'操作失败']);
		}

		//判断密码是否正确
		$userName = $request->input('username');
		$password = $request->input('password');
		$userInfo = User::where([['UserName',$userName],['Password',md5($password)]])->first();
		if(!$userInfo){
			return response()->json(['code'=>'F','msg'=>'旧密码错误']);
		}
		$newpassword = $request->input('newpassword'); //新密码一致性就靠前段来判断  后台就判断第一个密码
		
		$res = User::where('UserId',$userInfo['UserId'])->update(array('Password' => md5($newpassword) ));
		if($res){
			return response()->json(['code'=>'F','msg'=>'密码修改成功']);
		}else{
			return response()->json(['code'=>'F','msg'=>'密码修改失败']);
		}
	}
	
	/*
	 * 密码重置
	 * $vcode 验证码
	 * $username 用户名
	 * $newpassword 新密码
	 */
	public function findpwd(Request $request){
		$vcode = $request->input('resetcode');
		if (Session::get('resetcode') != $vcode){
			return response()->json(['code'=>'F','msg'=>'验证码错咯']);
		}
		$username = $request -> input ('username');
		$newpassword = $request -> input ('newpassword');
		$userInfo = User::where(['UserName',$username])->first();
		if(!$userInfo){
			return response()->json(['code'=>'F','msg'=>'请确认手机号或者用户名正确']);
		}
		$data = array(
			'Password' => $newpassword
		);
		$res = User::where('UserId',$userInfo['UserId'])->update(array('Password' => md5($newpassword) ));
		 
		if($res){
			Session::forget('resetcode');
			return response()->json(['code'=>'F','msg'=>'密码修改成功']);
		}else{
			return response()->json(['code'=>'F','msg'=>'密码修改失败']);
		}
	}

	
}
