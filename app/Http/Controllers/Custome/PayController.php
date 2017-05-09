<?php
	namespace App\Http\Controllers\Custome;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use App\Model\RechargeRecord;
	use App\Model\User;
	use Illuminate\Support\Facades\Log;
	class PayController extends Controller
	{
		public function index(Request $request)
		{
			if(empty(session('userInfo')))
				return response()->json(['code'=>'F','msg'=>'请先未登录！','url'=>'/login']);
			$order = uniqid().date('YmdHis');
			$amount = $request->input('amount');
			$RechargeRecord = new RechargeRecord();
			$RechargeRecord->amount = $amount;
			$RechargeRecord->status = 2;
			$RechargeRecord->channel = 2;
			$RechargeRecord->user_id = session('userInfo.UserId');
			$RechargeRecord->order = $order;
			$result = $RechargeRecord->save();
			if(! $result)
				return response()->json(['code'=>'F','msg'=>'操作失败！']);
			$alipay = app('alipay.web');
			$alipay->setOutTradeNo($order);
			$alipay->setTotalFee($amount);
			$alipay->setSubject('GSMGOOD充值');
			$alipay->setBody('goods_description');
			//$alipay->setQrPayMode('1'); //该设置为可选，添加该参数设置，支持二维码支付。
			// 跳转到支付页面。
			//return redirect()->to($alipay->getPayLink());
			return response()->json(['code'=>'S','msg'=>'操作成功','url'=>$alipay->getPayLink()]);
		}

		public function alpayNotify(Request $request)
		{
			file_put_contents('./1.txt', 'aaa');
			// 验证请求。
			if (!app('alipay.web')->verify()) {
			    	Log::notice('Alipay notify post data verification fail.', [
			        		'data' => $request->instance()->getContent()
			   	]);
			    	return 'fail';
			}
			// 判断通知类型。
			switch ($request ->input('trade_status','')) {
			    	case 'TRADE_SUCCESS':
			    	case 'TRADE_FINISHED':
			    		
			        		// TODO: 支付成功，取得订单号进行其它相关操作。
			        		Log::debug('Alipay notify post data verification success.', [
				            	'out_trade_no' => $request -> input('out_trade_no',''),
				            	'trade_no' => $request -> input('trade_no','')
			        		]);
			        		break;
			}
			
			return 'success';
		}

		public function webReturn(Request $request)
		{
			// 验证请求。
        			if (! app('alipay.web')->verify()) {
            				Log::notice('同步回调支付失败.', [
                				'data' => $request->getQueryString()
            			]);
            			return redirect('/users');
        			}

        			// 判断通知类型。
        			switch ($request->input('trade_status')) {
            			case 'TRADE_SUCCESS':
            			case 'TRADE_FINISHED':
                			// TODO: 支付成功，取得订单号进行其它相关操作。
                			Log::debug('同步回调支付成功！', [
                    				'out_trade_no' => $request->input('out_trade_no'),
                    				'trade_no' => $request->input('trade_no')
                			]);
                			$rechargeInfo = RechargeRecord::where('order',$request->input('out_trade_no'))->first();
	        			//$rechargeInfo = RechargeRecord::where('order','59098ed971eb520170503160337')->first();
	        			$rechargeInfo->status = 1;
	        			$result = $rechargeInfo->save();
	        			$userInfo = User::find($rechargeInfo->user_id);
	        			$userInfo->Balance += $rechargeInfo->amount * 10;
	        			$result = $userInfo->save();
                			break;
        			}
        			return redirect('/users');
		        	//return view('alipay.success');
		}
	}
?>
