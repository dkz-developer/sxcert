<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// 首页
Route::get('/', function () {
	return view('index');
});
 
// 登录注册页
Route::get('/enter', function () {
	return view('enter');
});

// 找回密码页面
Route::get('/findPassword', function () {
	return view('findPassword');
});

// 支付页面
Route::get('/pay', function () {
	return view('pay');
});

// 下载页
Route::get('/load', function () {
	return view('load');
});

// 下载页 search
Route::get('/search', function () {
	return view('search');
});

// 下载页 详情页
Route::get('/info', function () {
	return view('info');
});

// 个人 详情页
Route::get('/users', function () {
	return view('users');
});

// 意见反馈页面
Route::get('/feedback', function () {
	return view('feedback');
});

// 后台登录
Route::get('/admin/login', 'Admin\UserController@login');
Route::get('/admin/kit/captcha/{tmp}', 'Admin\UserController@captcha');
Route::post('/admin/loginHandle', 'Admin\UserController@loginHandle');
// 后台路由
Route::group(['namespace' => 'Admin','middleware'=>'adminauth'], function () {
	Route::get('/admin/logout', 'UserController@logout');
	Route::get('/admin/index', 'UserController@index');
	Route::get('/admin/addInfo', 'InfoController@addInfo');
	Route::get('/admin/infoList', 'InfoController@infoList');
	Route::get('/admin/common', 'InfoController@common');
	Route::post('/admin/commonAdd', 'InfoController@commonAdd');
	Route::post('/admin/fileUpload','InfoController@fileUpload');
	Route::post('/admin/addInfoHandle','InfoController@addInfoHandle');
	Route::post('/admin/delInfo','InfoController@rmInfo');
	Route::get('/admin/setHot','InfoController@setHot');
});
Route::get('/custome/kit/captcha/{tmp}', 'Custome\UserController@captcha');
// 前台
Route::group(['namespace' => 'Custome'], function () {
	Route::get('/custome/login', 'UserController@login');
	Route::post('/custome/smsre', 'SmsController@SmsRegister');
	Route::post('/custome/loadlist', 'LoadListController@loadlist');
	Route::post('/custome/detail', 'LoadListController@detail');
	Route::get('/custome/forum', 'ForumController@ForumList');
	Route::get('/custome/register', 'UserController@register');
	
});