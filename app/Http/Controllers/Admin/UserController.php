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
class UserController extends Controller
{
	public function login()
	{
		return view('admin.login');
	}

	public function loginHandle(Request $request)
	{
		$this->validate($request, [
			'captcha' => 'required|captcha',
			'userName' => 'required',
			'password' => 'required',
		]);
		$captcha = $request->input('captcha');
		dd($captcha);
		if (Session::get('milkcaptcha') != $captcha) 
			return redirect('admin/login')->withInput()->with('message','验证码错误');
		$userName = $request->input('userName');
		$password = md5($request->input('password'));
		$userInfo = AdminUser::where([['user_name',$userName],['password',$password]])->find();
		dd($userInfo);
		return redirect('admin/login')->withInput();
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
