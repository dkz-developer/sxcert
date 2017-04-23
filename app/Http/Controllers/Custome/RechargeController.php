<?php

namespace App\Http\Controllers\Custome;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BBSsession;
/*
 * 这个应该是回调地址吧 
 */
class RechargeController extends Controller
{
    /*
     * 充值
     */
    public function recharge(Request $request){
        //判断是否登录
        
        //充值金额
        //$total_fee = $request->postNum ( 'payAmount', 0 );
        // 创建支付单。
        $alipay = app('alipay.web');
        dd($alipay);
        $alipay->setOutTradeNo('order_id');
        $alipay->setTotalFee('order_price');
        $alipay->setSubject('goods_name');
        $alipay->setBody('goods_description');
        
        $alipay->setQrPayMode('4'); //该设置为可选，添加该参数设置，支持二维码支付。
        
        // 跳转到支付页面。
        return redirect()->to($alipay->getPayLink());        
        
    }
}
