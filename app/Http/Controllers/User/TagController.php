<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth;


class TagController extends Controller
{

    protected $auth;
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    //api
    public function getTags(Request $request)
    {

        $tagIds = null;
        $tags = '';

        if ($request->has('tags')) {
            $tagIds = $request->get('tags');
            $tags = Tag::select('id', 'tag_name', 'description')->whereIn('id', $tagIds)->get();
        } else {
            $tags = Tag::all(['id', 'tag_name', 'description']);
        }
        return response()->json([
            'status' => true,
            'data' => $tags,
        ]);
    }

    public function store(Request $request)
    {
        $name = $request->get('name-tag');
        $desc = $request->get('desc-tag');


        $userId = $this->user($request->bearerToken());
        $tag = '';
        try {
            $tag = Tag::create([
                'tag_name' => $name,
                'description' => $desc,
                'user_id' => $userId
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'error' => 'Có lỗi nhưng chưa có thời gian xử lý',
                'request' => $request->all()
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $tag,
            'request' => $request->all()
        ]);
    }

    public function getTopTags(Request $request)
    {
        $limit = 10;
        if ($request->has('limit')) {
            $limit = (int)$request->get('limit');
        }
        $tags = Tag::select('id', 'tag_name','quantity_use')->orderByDesc('quantity_use')->limit($limit)->get();

        return response()->json([
            'status' => true,
            'data' => $tags
        ]);
    }

    public function user($tokenId)
    {
        $verifiedIdToken =  $this->auth->verifyIdToken($tokenId);
        $userId = $verifiedIdToken->claims()->get('sub');
        return $userId;
    }
}
