<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InfoController extends Controller
{
	public function addInfo()
	{
		return view('admin.addInfo');
	}

	public function infoList()
	{
		return view('admin.infoList');
	}

	public function common()
	{
		return '常用资料添加页面';
	}
}
