<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactsController extends Controller
{
    // api

    // khi người dùng bấm like của post
    public function UserAddPostReact($postId)
    {
        $userId = Auth::user()->id;
        $reactId = 1; // mac dinh
        $res = Post::where('_id', $postId)->push(
            'reacts.data',
            [
                'reactId' => $reactId,
                'userId' => $userId,
            ],
            true
        );

        if ($res) {
            Post::where('_id', $postId)->increment('reacts.total');
        }

        return response()->json([
            'status' => $res,
        ]);
    }

    // khi người dùng huỷ like
    public function UserRemovePostReact($postId)
    {
        $userId = Auth::user()->id;
        $reactId = 1; // mac dinh
        $res = Post::where('_id', $postId)->pull(
            'reacts.data',
            [
                'reactId' => $reactId,
                'userId' => $userId,
            ],
            true
        );

        if ($res) {
            Post::where('_id', $postId)->decrement('reacts.total');
        }

        return response()->json([
            'status' => $res,
        ]);
    }

    public function checkPostReact($postId)
    {
        $userId = Auth::user()->id;
        $check = Post::where('_id', $postId)->where('reacts.data.userId', $userId)->count();
        return response()->json([
            'status' =>  $check >= 1 ? true : false
        ]);
    }
}
