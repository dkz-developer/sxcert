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
	return view('load');
});
 
// 登录注册页
Route::get('/login', function () {
	return view('enter');
});

Route::get('/register', function () {
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

// 客服页面
Route::get('/service', function () {
	return view('service');
});



// 下载页 search
Route::get('/search', function () {
	return view('search');
});

//   修改个人信息
Route::get('/personInfo', function () {
	return view('personInfo');
});

//   上传rom页面
// Route::get('/rom', function () {
// 	return view('rom');
// });

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
	Route::get('/admin/adda', function(){
		return view('admin.addAdmin');
	});
	Route::post('/admin/mpass', 'UserController@mpass');
	Route::post('/admin/dlAdmin', 'UserController@rmAdmin');
	Route::post('/admin/addAdmins', 'UserController@addAdmins');
	Route::get('/admin/adminList', 'UserController@adminList');
	Route::get('/admin/index', 'UserController@index');
	Route::get('/admin/addInfo', 'InfoController@addInfo');
	Route::get('/admin/infoList', 'InfoController@infoList');
	Route::get('/admin/common', 'InfoController@common');
	Route::post('/admin/commonAdd', 'InfoController@commonAdd');
	Route::post('/admin/fileUpload','InfoController@fileUpload');
	Route::post('/admin/addInfoHandle','InfoController@addInfoHandle');
	Route::post('/admin/delInfo','InfoController@rmInfo');
	Route::get('/admin/setHot','InfoController@setHot');
	Route::get('/admin/userList','UserController@userList');
	Route::post('/admin/changeMoney','UserController@changeMoney');
	Route::get('/admin/userInfo','InfoController@userInfo');
	Route::post('/admin/toExamine','InfoController@toExamine');
	Route::post('/admin/commonDelete', 'InfoController@commonDelete');
});
Route::get('/custome/kit/captcha/{tmp}', 'Custome\UserController@captcha');
// 前台
Route::group(['namespace' => 'Custome'], function () {
	Route::post('/custome/login', 'UserController@login');
	Route::post('/restpwd', 'UserController@restpwd');
	Route::post('/custome/smsre', 'SmsController@SmsRegister');
	Route::post('/custome/findPassword', 'SmsController@SmsFindPwd');
	Route::post('/custome/loadlist', 'LoadListController@loadlist');
	Route::post('/custome/detail', 'LoadListController@detail');
	Route::get('/custome/forum', 'ForumController@ForumList');
	Route::get('/custome/register', 'UserController@register');
	//Route::get('/info', 'LoadListController@detail');
	Route::get('/a/{id}', 'LoadListController@detail');
	Route::post('/custome/register', 'UserController@register');
	Route::get('/custome/logout', 'UserController@logout');
	// 个人 详情页
	Route::get('/users','UserController@userCenter');
	Route::post('/add/InfoComment','LoadListController@addInfoComment');
	Route::post('/buyInfo','LoadListController@download');
	Route::get('/firmware','LoadListController@userRom');
	Route::get('/gt_start','UserController@captcha');
	Route::post('/addUserInfo','LoadListController@userRomAdd');
	// 下载页
	Route::get('/','LoadListController@loadlist');
	Route::get('/rom','LoadListController@loadlist');
	Route::get('/b','LoadListController@searchBrand');
	Route::get('/c','LoadListController@searchCountry');
	Route::get('/d','LoadListController@searchModel');
	Route::get('/e','LoadListController@searchVersion');
	Route::get('/f','LoadListController@searchOs');
	Route::get('/g','LoadListController@searchType');
	Route::get('/h','LoadListController@searchKeyword');
	Route::get('/x','LoadListController@getAllList');
	Route::get('/alpay','PayController@index');
	Route::any('webreturn','PayController@webReturn');
	Route::post('webnotify','PayController@alpayNotify');
});