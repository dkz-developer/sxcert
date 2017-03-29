<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InfoController extends Controller
{
	public function addInfo()
	{
		return '这是资料添加页面';
	}

	public function infoList()
	{
		return '这是资料列表页面';
	}

	public function common()
	{
		return '常用资料添加页面';
	}
}
