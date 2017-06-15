<?php
	namespace App\Http\Controllers\Admin;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use App\Model\admin\Theme;
	use App\Model\Article;
	use DB;
	class ArticleController extends Controller
	{
		
		public function articleList()
		{
			$list = DB::table('Article')->join('Theme','Article.theme_id','=','Theme.id')->select('Theme.theme_name','Article.id','Article.title','Article.view_num','Article.created_at','Article.user_name','Article.is_top','Article.is_brilliant','Article.user_id','Article.theme_id','Article.like_num','Article.reply_num')->where('Article.status',1)->orderBy('Article.created_at','desc')->paginate(20);
			$count = Article::where('status',1)->count();
			$themeInfo = Theme::where('status',1)->get();
			return view('admin.articleList',['list'=>$list,'count'=>$count,'themeInfo'=>$themeInfo]);
		}

		public function channelList()
		{
			$list = Theme::where('status',1)->paginate(15);
			return view('admin.channelList',['list'=>$list]);
		}

		public function addChannel(Request $request)
		{
			$channel_name  = $request->input('channel_name','');
			if(empty($channel_name) || strlen($channel_name) > 50) {
				return response()->json(['code'=>'F','msg'=>'频道名不能为空，且不能超过50个字符！']);
			}
			$Theme = new Theme();
			$Theme->theme_name = $channel_name;
			$result = $Theme->save();
			if($result)
				return response()->json(['code'=>'S','msg'=>'操作成功！']);
			return response()->json(['code'=>'F','msg'=>'操作失败！']);
		}

		public function editChannel(Request $request)
		{
			$channel_name = $request->input('channel_name','');
			$id = $request->input('id');
			if(empty($channel_name) || strlen($channel_name) > 50) {
				return response()->json(['code'=>'F','msg'=>'频道名不能为空，且不能超过50个字符！']);
			}

			if(! is_numeric($id)) {
				return response()->json(['code'=>'F','msg'=>'参数错误！']);
			}
			$Theme = new Theme();
			$result = $Theme->where('id',$id)->update(['theme_name'=>$channel_name]);
			 if($result)
				return response()->json(['code'=>'S','msg'=>'操作成功！']);
			return response()->json(['code'=>'F','msg'=>'操作失败！']);
		}

		public function delChannel(Request $request)
		{
			$id = $request->input('id');
			if(!is_numeric($id))
				return response()->json(['code'=>'F','msg'=>'参数错误！']);
			$Theme = new Theme();
			$result = $Theme->where('id',$id)->update(['status'=>2]);
			 if($result)
				return response()->json(['code'=>'S','msg'=>'操作成功！']);
			return response()->json(['code'=>'F','msg'=>'操作失败！']);
		}
	}
?>