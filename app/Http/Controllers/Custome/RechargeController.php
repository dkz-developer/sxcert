<?php

namespace App\Http\Controllers\Custome;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BBSsession;

class RechargeController extends Controller
{
    /*
     * 充值
     */
    public function Recharge(Request $request){
        //判断是否登录
        
        //充值金额
        $total_fee = $request->postNum ( 'payAmount', 0 );
        
        
        
    }
}
