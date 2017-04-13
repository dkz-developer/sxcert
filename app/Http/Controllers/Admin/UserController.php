<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AdminUser;
//引用对应的命名空间
use Gregwar\Captcha\CaptchaBuilder;
use Session;
use DB;
namespace App\Model\User;
class UserController extends Controller
{
	public function userList()
	{
		 $count = User::count();
		 $list = User::paginate(15);
		 return view('admin.userList',['count'=>$count,'list'=>$list]);
	}

	public function index()
	{
		return view('admin.index');
	}

	public function login()
	{
		return view('admin.login');
	}

	public function loginHandle(Request $request)
	{
		$captcha = $request->input('captcha');
		if (Session::get('milkcaptcha') != $captcha) 
			return response()->json(['code'=>'F','msg'=>'验证码错误']);
		$userName = $request->input('userName');
		$password = $request->input('password');
		$userInfo = AdminUser::where([['user_name',$userName],['password',md5($password)]])->first();
		if(! $userInfo)
			return response()->json(['code'=>'F','msg'=>'用户名或密码不正确']);
		session(['adminInfo'=>$userInfo->toArray()]);
		return response()->json(['code'=>'S','msg'=>'登录成功','url'=>'/admin/index']);
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
}
