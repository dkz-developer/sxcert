<?php

namespace App\Http\Controllers\Custome;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $total_fee = $request->getNum ( 'payAmount', 0 );
        // 创建支付单。
        $alipay = app('alipay.web');
        dd($alipay);
        $alipay->setOutTradeNo('order_id');
        $alipay->setTotalFee($total_fee);
        $alipay->setSubject('goods_name');
        $alipay->setBody('goods_description');
        
        $alipay->setQrPayMode('4'); //该设置为可选，添加该参数设置，支持二维码支付。
        
        // 跳转到支付页面。
        return redirect()->to($alipay->getPayLink());        
        
    }
    
    
    /**
     * 异步通知
     */
    public function webNotify()
    {
        // 验证请求。
        if (! app('alipay.web')->verify()) {
            //Log::notice('Alipay notify post data verification fail.', [
            //'data' => Request::instance()->getContent()
            //]);
            return 'fail';
        }
    
        // 判断通知类型。
        switch (Input::get('trade_status')) {
            case 'TRADE_SUCCESS':
            case 'TRADE_FINISHED':
                // TODO: 支付成功，取得订单号进行其它相关操作。
                Log::debug('Alipay notify post data verification success.', [
                'out_trade_no' => Input::get('out_trade_no'),
                'trade_no' => Input::get('trade_no')
                ]);
                break;
        }
    
        return 'success';
    }
}
