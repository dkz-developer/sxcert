<?php
    namespace App\Http\Controllers\Admin;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class ArticleController extends Controller
    {
        public function channelList()
        {
            return view('admin.channelList');
        }
    }
?>