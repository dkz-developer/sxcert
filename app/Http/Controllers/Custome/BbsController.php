<?php
	namespace App\Http\Controllers\Custome;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use App\Model\Theme;
	use App\Model\Article;
	class BbsController extends Controller
	{
		public function index()
		{
			$list = Theme::where('status',1)->get()->toArray();
			return view('index',['list'=>$list]);
		}

		public function addPage($id)
		{
			if( empty(session('userInfo')) ) 
				return redirect('/login');
			$themeInfo = Theme::find($id);
			if(empty($themeInfo))
				return redirect('/bbs');
			$where = [
				['theme_id',$id],
				['status',1]
			];
			$hotList = Article::where($where)->select('id','title','view_num','created_at','user_name','is_top','is_brilliant','user_id','theme_id','like_num','reply_num')->orderBy('like_num')->skip(0)->take(5)->get();
			$articleCount = Article::where('user_id',session('userInfo.UserId'))->count();
			return view('topic_add',['themeInfo'=>$themeInfo,'hotList'=>$hotList,'articleCount'=>$articleCount]);	
		}

		public function forum($id)
		{
			// 获取模板信息
			if(! is_numeric($id))
				return redirect('/bbs');
			$themeInfo = Theme::find($id);
			$Article = new Article();
			$where = [
				['theme_id',$id],
				['status',1]
			];
			$list = $Article->where($where)->select('id','title','view_num','created_at','user_name','is_top','is_brilliant','user_id','theme_id','like_num','reply_num')->orderBy('is_top','desc')->orderBy('created_at','desc')->simplePaginate(20);
			$hotList = $Article->where($where)->select('id','title','view_num','created_at','user_name','is_top','is_brilliant','user_id','theme_id','like_num','reply_num')->orderBy('like_num')->skip(0)->take(5)->get();
			$where = [
				['status',1],
				['user_id',session('UserId.UserId')],
			];
			$articleCount = $Article->where($where)->count();
			return view('forum',['themeInfo'=>$themeInfo,'list'=>$list,'hotList'=>$hotList,'articleCount'=>$articleCount]);
		}

		public function addArticle(Request $request)
		{
			if( empty(session('userInfo')) ) 
				return redirect('/login');
			$themeId = $request->input('theme');
			if(empty($themeId))
				return redirect('/forum/topic/add');
			$title = $request->input('title');
			$titleLen = strlen($title);
			if($titleLen <= 0 || $titleLen > 50)
				return redirect('/forum/topic/add');
			$content = $request->input('content');
			$contentLen = strlen($content);
			if(empty($content))
				return redirect('/forum/topic/add');
			$isNeedMoney = $request->input('isNeedMoney',false);
			$Article = new Article();
			if ($request->has('isNeedMoney')) {
				$money = $request->input('money',0);
				if($money <=0 )
					return redirect('/forum/topic/add');
				$Article->money = $money;
			}
			$Article->title = $title;
			$Article->content = $content;
			$Article->theme_id = $themeId;
			$Article->user_id = session('userInfo.UserId');
			$Article->user_name = session('userInfo.UserName');
			$Article->save();
		}	
	}
?>