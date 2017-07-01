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
// 登录注册页
Route::get('/login', 'Custome\UserController@loginPage');

Route::get('/register', 'Custome\UserController@loginPage');

// 找回密码页面
Route::get('/findPassword', function () {
	return view('findPassword');
});

// 客服页面
Route::get('/service', 'Custome\LoadListController@service');

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
Route::get('/feedback', 'Custome\UserController@feedback');

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
	Route::get('/admin/system/base','SystemSetController@base');
	Route::post('/admin/changeSeo','SystemSetController@changeSeo');
	Route::post('/admin/article/addChannel','ArticleController@addChannel');
	Route::post('/admin/article/editChannel','ArticleController@editChannel');
	Route::post('/admin/article/delChannel','ArticleController@delChannel');
	Route::get('/admin/article/channelList','ArticleController@channelList');
	Route::get('/admin/article/list','ArticleController@articleList');
	Route::get('/admin/article/replyList','ArticleController@replyList');
	Route::post('/admin/article/setTop','ArticleController@setTop');
	Route::post('/admin/article/setTop','ArticleController@setTop');
	Route::post('/admin/article/setBrilliant','ArticleController@setBrilliant');
	Route::post('/admin/article/delArticle','ArticleController@delArticle');
	Route::get('/admin/article/delReply','ArticleController@delReply');
});
Route::get('/custome/kit/captcha/{tmp}', 'Custome\UserController@captcha');
// 支付页面
Route::get('/pay', 'Custome\LoadListController@pay');
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
	Route::match(['get', 'post'],'/','LoadListController@loadlist');
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
	Route::any('webnotify','PayController@alpayNotify');

	// bbs 论坛
	Route::get('/bbs', 'BbsController@index');
	// 帖子列表页
	Route::get('/forum/topic/{id?}','BbsController@forum');
	Route::post('/addArticle','BbsController@addArticle');
	// 帖子 -- 发布主题页
	Route::get('/forum/topic/add/{id}','BbsController@addPage'); // 帖子详情页页
	Route::get('/thread/topic/{id}','BbsController@detail');
	Route::get('/like/{id}','BbsController@likeArticle');
	Route::post('/reply','BbsController@reply');
});