<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public function homePage()
    {
        return view('layout.home_page', ['title' => 'Trang chủ']);
    }

    public function topicPage($topicName,$topicId)
    {
        return view('layout.home_page', ['topicId' => $topicId, 'topicName' => $topicName , 'title' => 'Bài viết về ' . $topicName]);
    }
}
