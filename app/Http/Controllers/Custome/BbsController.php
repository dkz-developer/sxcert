<?php
	namespace App\Http\Controllers\Custome;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use App\Model\Theme;
	use App\Model\Article;
	use DB;
	class BbsController extends Controller
	{
		protected $seoTitle;
		protected $search;
		protected $keyword;
		public function __construct()
		{
			$this->seoTitle = DB::table('SystemSet')->find(1);
			$this->search = DB::table('SystemSet')->find(2);
			$this->keyword = DB::table('SystemSet')->find(3);
		}
		public function reply(Request $request)
		{
			if(empty(session('userInfo')))
				return response()->json(['code'=>'A','msg'=>'未登录！']);
			$parentId = $request->input('parent_id',0);
			$replyId = $request->input('reply_id',0);
			if(! is_numeric($parentId))
				return response()->json(['code'=>'F','msg'=>'参数错误！']);
			$content = $request->input('content');
			if(empty($content))
				return response()->json(['code'=>'F','msg'=>'内容不能为空！']);
			$ArticleInfo = Article::find($parentId);
			$Article = new Article();
			$Article->parent_id = $parentId;
			$Article->user_id = session('userInfo.UserId');
			$Article->user_name = session('userInfo.UserName');
			$Article->content = $content;
			$Article->reply_id = $replyId;
			$Article->theme_id = $ArticleInfo->theme_id;
			$Article->reply_time = date('Y-m-d H:i:s');
			$res = $Article->save();
			if($res){
				$Article->where('id',$parentId)->increment('reply_num');
				return response()->json(['code'=>'S','msg'=>'回帖成功！','data'=>$Article->id]);
			}
			return response()->json(['code'=>'F','msg'=>'回帖失败！']);
		}

		public function detail($id,Request $request)
		{
			$Article = new Article();
			$Article::where('id',$id)->increment('view_num');
			$theme_id = Article::where('id',$id)->value('theme_id');
			$themeInfo = Theme::find($theme_id);
			$page = $request->input('page',1);
			$list = [];
			if(1 == $page) {
				$list = $Article->where('id',$id)->first();
				$list->article_num = $Article->where([['user_id',$list->user_id],['parent_id',0]])->count();
				$list->reply_num = $Article->where([['user_id',$list->user_id],['parent_id','<>',0]])->count();
				if(! empty(session('userInfo')))
					$count = DB::table('ArticleLike')->where([['ArticleId',$id],['UserId',session('userInfo.UserId')]])->count();
				else
					$count = 0;
				$list->count = $count;
				$list->is_view = 'S';
				if(0 <= intval($list->money)) {
					if(empty(session('userInfo'))) {
						$list->is_view = 'F';
					}else{
						$res = DB::table('ArticleBuyRecord')->where([['article_id',$list->id],['userId',session('userInfo.UserId')]])->count();
						if($res >= 1 || $list->user_id == session('userInfo.UserId'))
							$list->is_view = 'S';
						else
							$list->is_view = 'F';
					}
				}
			}
			$replylist = $Article->where('parent_id',$id)->orderBy('id','asc')->paginate(5);
			$title = Article::where('id',$id)->value('title');
			foreach ($replylist as $key => $value) {
				if(0 != $value->reply_id) 
					$value->replyInfo = $Article->find($value->reply_id);
				$value->is_like = DB::table('ArticleLike')->where([['ArticleId',$value->id],['UserId',session('userInfo.UserId')]])->count();
				$value->reply_num = $Article->where([['user_id',$value->user_id],['parent_id','<>',0]])->count();
				$value->article_num = $Article->where([['user_id',$value->user_id],['parent_id',0]])->count();
			}
			$maxPage = $Article->where('parent_id',$id)->count();
			$maxPage = ceil($maxPage/5);
			return view('thread',['themeInfo'=>$themeInfo,'list'=>$list,'replylist'=>$replylist,'id'=>$id,'maxPage'=>$maxPage,'search'=>$this->search,'keyword'=>$this->keyword,'title'=>$title]);
		}

		public function likeArticle($id)
		{
			if(empty(session('userInfo')))
				return response()->json(['code'=>'F','msg'=>'操作失败！']);
			if(! is_numeric($id))
				return response()->json(['code'=>'F','msg'=>'参数错误！']);
			$likeRes = DB::table('ArticleLike')->where([['ArticleId',$id],['UserId',session('userInfo.UserId')]])->first();
			if(empty($likeRes)) {
				$res = Article::where('id',$id)->increment('like_num');
				if($res){
					DB::table('ArticleLike')->insert(['ArticleId'=>$id,'UserId'=>session('userInfo.UserId')]);
					return response()->json(['code'=>'S','msg'=>'操作成功！']);
				}
			}
			return response()->json(['code'=>'F','msg'=>'操作失败！']);
			
		}

		public function index()
		{
			$list = Theme::where('status',1)->get()->toArray();
			foreach ($list as $key => $value) {
				$list [$key] ['theme_num'] = Article::where([['status',1],['parent_id',0],['theme_id',$value ['id']]])->count();
				$list [$key] ['repley_num'] = Article::where([['status',1],['parent_id','<>',0],['theme_id',$value ['id']]])->count();
			}
			$newList = Article::select('id','title')->orderBy('created_at','desc')->where([['status',1],['parent_id',0]])->skip(0)->take(5)->get();
			$newReply = Article::select('id','title')->orderBy('reply_time','desc')->where([['status',1],['parent_id',0]])->skip(0)->take(5)->get();
			$hotList = Article::select('id','title')->orderBy('view_num','desc')->where([['status',1],['parent_id',0]])->skip(0)->take(5)->get();
			return view('index',['list'=>$list,'newList'=>$newList,'newReply'=>$newReply,'seoTitle'=>$this->seoTitle,'hotList'=>$hotList,'search'=>$this->search,'keyword'=>$this->keyword]);
		}

		public function addPage($id,$articleId=0)
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
			$list = '';
			if(! empty($articleId))
				$list = Article::find($articleId);
			$articleCount = Article::where([['user_id',session('userInfo.UserId')],['parent_id',0]])->count();
			$replyCount = Article::where([['user_id',session('userInfo.UserId')],['parent_id','<>',0]])->count();
			return view('topic_add',['themeInfo'=>$themeInfo,'hotList'=>$hotList,'articleCount'=>$articleCount,'replyCount'=>$replyCount,'search'=>$this->search,'keyword'=>$this->keyword,'list'=>$list]);	
		}

		public function forum($id=0,Request $request)
		{
			// 获取模板信息
			if(! is_numeric($id))
				return redirect('/bbs');
			$Article = new Article();
			$where = [
				['theme_id',$id],
				['status',1],
				['parent_id',0]
			];
			if($request->has('keyword')) {
				$keyword = $request->input('keyword');
				array_shift($where);
				array_push($where, ['title','like',"%{$keyword}%"]);
			}else{
				$themeInfo = Theme::find($id);
			}
			$list = $Article->where($where)->select('id','title','view_num','created_at','user_name','is_top','is_brilliant','user_id','theme_id','like_num','reply_num')->orderBy('is_top','desc')->orderBy('created_at','desc')->simplePaginate(20);
			$hotList = $Article->where($where)->select('id','title','view_num','created_at','user_name','is_top','is_brilliant','user_id','theme_id','like_num','reply_num')->orderBy('like_num')->skip(0)->take(5)->get();
			$articleCount = Article::where([['user_id',session('userInfo.UserId')],['parent_id',0]])->count();
			$replyCount = Article::where([['user_id',session('userInfo.UserId')],['parent_id','<>',0]])->count();
			return view('forum',['themeInfo'=>isset($themeInfo) ? $themeInfo : [],'list'=>$list,'hotList'=>$hotList,'articleCount'=>$articleCount,'replyCount'=>$replyCount,'search'=>$this->search,'keyword'=>$this->keyword]);
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
			if($titleLen <= 0 || $titleLen > 80)
				return redirect('/forum/topic/add');
			$content = $request->input('content');
			$contentLen = strlen($content);
			if(empty($content))
				return redirect('/forum/topic/add');
			$isNeedMoney = $request->input('isNeedMoney',false);
			$id = $request->input('id',0);
			if(!empty($id) && is_numeric($id)){
				$Article = Article::find($id);
				if($Article->user_id != session('userInfo.UserId'))
					return redirect('/forum/topic/add');
			}else{
				$Article = new Article();
			}
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
			return redirect('/thread/topic/'.$Article->id);
		}

		public function buyArticle(Request $request)	
		{
			$articleId = $request->input('id');
			if(empty(session('userInfo.UserId')))
				return response()->json(['code'=>'F','msg'=>'请先登录','url'=>'/login']);
			$userId = session('userInfo.UserId');
			$userInfo = DB::table('User')->where('UserId',$userId)->first();
			$articleInfo = Article::find($articleId);
			if($userInfo->Balance < $articleInfo->money)
				return response()->json(['code'=>'F','msg'=>'金币余额不足,请先充值!','url'=>'/pay']);
			DB::beginTransaction();
			$userRes = DB::table('User')->decrement('Balance',$articleInfo->money);
			$recordRes = DB::table('ArticleBuyRecord')->insert(['article_id'=>$articleId,'userId'=>$userId,'pay_money'=>$articleInfo->money]);
			if($userRes && $recordRes) {
				DB::commit();
				return response()->json(['code'=>'S','msg'=>'购买成功']);
			}
			DB::rollBack();
			return response()->json(['code'=>'F','msg'=>'购买失败，请联系网站管理员','url'=>"/thread/topic/{$articleId}"]);
		}
	}
?>