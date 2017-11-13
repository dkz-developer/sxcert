<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class IndexController extends Controller
{
    public function itemslist(Request $request)
    {
        $where = [['state', 1]];
        $list = DB::table('ServiceItems')->where($where)->select('id', 'title', 'type', 'need_date', 'price')->orderBy('id','desc')->paginate(20);
        return view('serve', ['list'=>$list]);
    }

    public function itemsInfo($id)
    {
        $info = DB::table('ServiceItems')->find($id);
        return view('serve_info', ['info'=>$info]);
    }
}
