<?php
	namespace App\Http\Controllers\Custome;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use App\Model\Theme;
	use App\Model\Article;
	use DB;
	class BbsController extends Controller
	{

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
			$Article = new Article();
			$Article->parent_id = $parentId;
			$Article->user_id = session('userInfo.UserId');
			$Article->user_name = session('userInfo.UserName');
			$Article->content = $content;
			$Article->replyId = $replyId;
			$res = $Article->save();
			if($res)
				return response()->json(['code'=>'S','msg'=>'回帖成功！','data'=>$Article->id]);
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
				$sql = "SELECT a.*,count('b.user_id') AS article_num FROM Article as a LEFT JOIN Article as b ON a.user_id = b.user_id WHERE a.id = ? ";
				$list = DB::table('Article as a')->LeftJoin('Article as b','a.user_id','=','b.user_id')->select('a.*',DB::raw('count(b.user_id) as article_num'))->where('a.id',$id)->first();
				if(! empty(session('userInfo')))
					$count = DB::table('ArticleLike')->where([['ArticleId',$id],['UserId',session('userInfo.UserId')]])->count();
				else
					$count = 0;
				$list->count = $count;
			}
			$replylist = $Article->where('parent_id',$id)->orderBy('id','asc')->paginate(5);
			$maxPage = $Article->where('parent_id',$id)->count();
			$maxPage = ceil($maxPage/5);
			return view('thread',['themeInfo'=>$themeInfo,'list'=>$list,'replylist'=>$replylist,'id'=>$id,'maxPage'=>$maxPage]);
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