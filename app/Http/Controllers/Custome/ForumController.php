<?php

namespace App\Http\Controllers\Custome;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BBSsession;
use App\Model\BBSTopic;

class ForumController extends Controller
{
    //论坛分类
    public function ForumList(Request $request){
        $type = $request->input('type' ,1);
        
        if($type){
            $list = BBSsession::where('type',$type)
                    ->leftJoin('BBSTopic', 'BBSsession.SId', '=', 'BBSTopic.SId')
                    ->leftJoin('BBSReply', 'BBSReply.TId', '=', 'BBSTopic.TId')
                    ->groupBy('BBSsession.SId')
                    ->select('BBSsession.SId','BBSsession.SName',"count('BBSTopic.SId') as TCount")
                    //->select('BBSsession.SId','BBSsession.SName',"count('BBSTopic.SId') as TCount",'count(.BBSReply.TId.) as RCount','max(BBSsession.UpdateTime)')
                    ->get();
            
        }
        
        dd($list);
    }
}
