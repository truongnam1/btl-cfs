<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    protected $auth;
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function getPost(Request $request, $postId)
    {
        Debugbar::info($request->session()->all());
        $post = Post::find($postId);
        if ($post && $post->title && $post->content) {
            $this->userViewPost($request, $postId);
            $title = $post->title;
            if (mb_strlen($post->title) > 40) {
                # code...
                $title =  substr($post->title, 0, 40);
            }
            return view('layout.post_page', ['post' => $post, 'title' =>  $title]);
        }
        return abort(404);
    }

    public function getPostOfTopic(Request $request, $topicId, $topicName)
    {
        return view('layout.posts_of_topic', ['topicId' => $topicId, 'topicName' => $topicName]);
    }

    // api
    function index(Request $request)
    {
        $offset = 0;
        $limit = 10;
        if ($request->has('offset')) {
            $offset = (int)$request->get('offset');
        }

        if ($request->has('limit')) {
            $limit = (int)$request->get('limit');
        }
        if ($request->has('topicId')) {
            $topicId = (int)$request->get('topicId');
            
            return Post::select('_id', 'title', 'content', 'views.total', 'comments.total', 'reacts.total')
            ->where('tags',$topicId)
            ->orderByDesc('created_at')->skip($offset)->limit($limit)->get();
        }
        return Post::select('_id', 'title', 'content', 'views.total', 'comments.total', 'reacts.total')
            ->orderByDesc('created_at')->skip($offset)->limit($limit)->get();

        //  Post::all();
    }

    public function store(Request $request)
    {
        $title = $request->get('title');
        $content = $request->get('content');
        $tagsId = $request->get('tags-id');
        // $accessLevelId = (int)$request->get('access-level-id');

        // $userId = $this->user($request->bearerToken());

        $userId = Auth::user()->id;

        if ($tagsId) {
            $amountTag = Tag::whereIn('id', $tagsId)->count();
        }

        $post = '';
        if ($tagsId == null || $amountTag == count($tagsId)) {
            if ($tagsId == null) {
                $tagsId = [];
            }
            Tag::whereIn('id', $tagsId)->increment('quantity_use');
            // foreach ($variable as $key => $value) {
            //     # code...
            // }
            $data = [
                "user_id" => $userId,
                "title" => $title,
                "content" => $content,
                // 'access_level' => $accessLevelId,
                'tags' => $tagsId,
                'comments' => [
                    'total' => 0,
                    'data' => []
                ],
                'reacts' => [
                    'total' => 0
                ],
                'views' => [
                    'total' => 0
                ]
            ];
            $post = Post::create($data);

            return response()->json([
                'status' => true,
                'data' => $post,
            ]);
        }


        return response()->json([
            'status' => false,
            'amountTag' => $amountTag,
            'request' => $request->all(),

        ]);
    }

    // api get thoong tin cho modal post
    public function getPostModal($postId)
    {
        // ngay, like, view, tagname
        $post = Post::select('reacts', 'views', 'created_at', 'tags', 'comments')->where('_id', $postId)->get();

        return response()->json([
            'status' => true,
            'data' => $post
        ]);
    }

    public function user($tokenId)
    {
        $verifiedIdToken =  $this->auth->verifyIdToken($tokenId);
        $userId = $verifiedIdToken->claims()->get('sub');
        return $userId;
    }

    public function userViewPost($request, $postId)
    {
        $sessionToken = $request->session()->get('_token');
        $ip = request()->ip();
        $userId = null;
        if (Auth::check()) {
            $userId = Auth::user()->id;
        }

        DB::table('posts_view')->insert([
            'post_id' => $postId,
            'user_id' => $userId,
            'ip' => $ip,
            'session_id' => $sessionToken,
            "created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),

        ]);

        Post::where('_id', $postId)->increment('views.total');
    }

    public function getUserPost($user_id) {
        return Post::select('_id', 'title', 'content', 'views.total', 'comments.total', 'reacts.total', 'created_at')
            ->where('user_id', $user_id)
            ->orderByDesc('created_at')->get();
    }

    public function deleteUserPost(Request $request) {
        $postId = $request->get('postId');
        $status = Post::where('_id', $postId)->delete();
        return response()->json([
            'status' => $status,
        ]); 
    }
}