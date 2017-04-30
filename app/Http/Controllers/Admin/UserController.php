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
use App\Model\User;
use App\Model\RechargeRecord;
class UserController extends Controller
{
	public function userList(Request $request)
	{
		$index = $request->input('index',0);
		$stime = $request->input('start_time',false);
		$etime = $request->input('end_time',false);
		$keyword = $request->input('keyword',false);
		$where = [];
		if($index && $keyword) {
			1 == $index  && array_push($where, ['UserId',intval($keyword)]);
			2 == $index  && array_push($where, ['UserName',$keyword]);
			3 == $index && array_push($where, ['Mobile',$keyword]);
		}
		if($stime || $etime) {
			$stime && array_push($where, ['CreateTime','>=',$stime.' 00:00:00']);
			$etime && array_push($where, ['CreateTime','<=',$etime.' 23:59:59']);
		}
		$count = User::where($where)->count();
		$list = User::where($where)->paginate(15);
		return view('admin.userList',['count'=>$count,'list'=>$list]);
	}

	public function changeMoney(Request $request)
	{
		$balance = $request->input('balance',0);
		$id = $request->input('id',0);
		$User = User::find($id);
		$User->Balance += intval($balance);
		$result = $User->save();
		if($result) {
			$record = new RechargeRecord();
			$record->amount = $balance;
			$record->status = 1;
			$record->channel = 1;
			$record->user_id = $id;
			$record->save();
			return response()->json(['code'=>'S','msg'=>'修改成功！','data'=>number_format($User->Balance)]);
		}
		return response()->json(['code'=>'F','msg'=>'修改失败！']);
	}

	public function index()
	{
		return view('admin.index');
	}

	public function login()
	{
		return view('admin.login');
	}

	public function adminList()
	{
		$list = AdminUser::simplePaginate(20);
		return view('admin.adminList',['list'=>$list]);
	}

	public function  mpass(Request $request)
	{
		$id = $request->input('id');
		$password = $request->input('password');
		if(strlen($password) < 6)
			return response()->json(['code'=>'F','msg'=>'密码格式不正确！']);

		$AdminUser = AdminUser::find($id);
		$AdminUser->password = md5($password);
		$result = $AdminUser->save();
		if($result)
			return response()->json(['code'=>'S','msg'=>'操作成功!']);
		else 
			return response()->json(['code'=>'F','msg'=>'操作失败!']);
	}

	public function rmAdmin(Request $request)
	{
		$id = $request->input('id');
		$result = AdminUser::where('id',$id)->delete();
		if($result)
			return response()->json(['code'=>'S','msg'=>'操作成功!']);
		else 
			return response()->json(['code'=>'F','msg'=>'操作失败!']);
	}

	public function addAdmins(Request $request)
	{
		$AdminUser = new AdminUser();
		$userName = $request->input('userName');
		$password = $request->input('password');
		if(strlen($userName) < 6 || strlen($password) < 6) 
			return response()->json(['code'=>'F','msg'=>'用户名或密码格式不正确!']);
		$AdminUser->user_name = $userName;
		$AdminUser->password = md5($password);
		$result = $AdminUser->save();
		if($result)
			return response()->json(['code'=>'S','msg'=>'操作成功!']);
		else 
			return response()->json(['code'=>'F','msg'=>'操作失败!']);
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
