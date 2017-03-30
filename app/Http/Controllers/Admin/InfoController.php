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
		return view('admin.common');
	}

	public function commonPage()
	{
		return view('admin.commonPage');
	}
}
