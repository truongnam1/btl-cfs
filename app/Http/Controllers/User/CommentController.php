<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $content = $request->get('content');
        $userId = Auth::user()->id;
        $res = Post::where('_id', $postId)->push(
            'comments.data',
            [
                "content" => $content,
                "user_id" => $userId,
                'created_at' => date('Y-m-d H:i:s')
            ],
            true
        );

        if ($res) {
            Post::where('_id', $postId)->increment('comments.total');
        }

        return response()->json([
            'status' => $res,
        ]);
    }

    public function get(Request $request, $postId)
    {
        $limit = 10;
        $offset = 0;
        return Post::select('comments')->where('_id', $postId)->orderBy('created_at')->get();
    }
}
