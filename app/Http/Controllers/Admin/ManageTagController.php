<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Nette\Utils\Random;
use Kreait\Firebase\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Barryvdh\Debugbar\Facade as Debugbar;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ManageTagController extends Controller
{
    protected $auth;
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function index(Request $request)
    {
        // $user = FacadesAuth::loginUsingId('bCDG41Jo8QSTwlEvf5zH1TOaACX2');
        // $user = FacadesAuth::user();
        Debugbar::info($request);
        // FacadesAuth::logout();

        return view('admin.layout.tags', ['title' => 'Quản lý nhãn']);
    }

    //api
    public function getTags()
    {
        $tags = Tag::all();

        return response()->json([
            'status' => true,
            'data' => $tags
        ]);
    }

    public function getTagTable(Request $request)
    {
        $limit = (int)$request->input('length');
        $start = (int)$request->get('start');
        $data = [];

        $colOrder = $request->get('order')[0]['column'];
        $typeOrder = $request->get('order')[0]['dir'];   // get type orderby (desc hay asc)
        $columns  = $request->get('columns');
        $colNameOrder = $columns[$colOrder]['data']; // tên cột orderby
        $searchValue = $request->get('search')['value'];

        $total_data = Tag::count();
        $tags = '';
        // Tag::skip($start)->limit($limit)->with('user:id,name')->get();


        if ($searchValue) {

            if (($colNameOrder == 'created_at' || $colNameOrder == 'tag_name' || $colNameOrder == 'quantity_use') && $typeOrder != null) {
                $tags  = Tag::where('tag_name', 'like', "$searchValue%")
                    ->orderBy($colNameOrder, $typeOrder)->skip($start)->limit($limit)->with('user:id,name')->get();
            } else {
                $tags  = Tag::where('tag_name', 'like', "$searchValue%")
                    ->skip($start)->limit($limit)->with('user:id,name')->get();
            }
        } else {
            // nếu không có value search
            if (($colNameOrder == 'created_at' || $colNameOrder == 'tag_name' || $colNameOrder == 'quantity_use') && $typeOrder != null) {
                $tags  = Tag::orderBy($colNameOrder, $typeOrder)->skip($start)->limit($limit)->with('user:id,name')->get();
            } else {
                $tags  = Tag::skip($start)->limit($limit)->with('user:id,name')->get();
            }
        }

        foreach ($tags as $tag) {
            $temp = [];
            $temp['tagId'] = $tag->id;
            $temp['tag_name'] = $tag['tag_name'];
            $temp['desc'] = $tag['description'];

            $temp['userCreate'] = $tag->user;
            $temp['userCreate']['urlProfile'] = route('manage-profile-user', ['idUser' => $tag->user->id]);

            $temp['quantity_use'] = 1;
            $temp['created_at'] = $tag['created_at'];
            $temp['action'] = '';
            array_push($data, $temp);
        }

        return  [
            'draw' => (int)$request->get('draw'),
            'recordsTotal' => $total_data,
            'recordsFiltered' => $total_data,
            'data' => $data,
            'user' => FacadesAuth::user(),
            // 'ss' => $ss
        ];
    }

    public function handleDataTagsTable()
    {
    }

    public function store(Request $request)
    {
        $name = $request->get('name-tag');
        $desc = $request->get('desc-tag');


        $userId = $this->user($request->bearerToken());
        $tag = Tag::create([
            'tag_name' => $name,
            'description' => $desc,
            'user_id' => $userId
        ]);

        return response()->json([
            'status' => true,
            'data' => $tag
        ]);
    }

    public function update(Request $request, $tagId)
    {
        $name = $request->get('name-tag');
        $desc = $request->get('desc-tag');
        $tagId = (int)$tagId;

        $tag = Tag::find($tagId);
        $tagRes = '';
        if ($tag) {
            $tagRes = $tag->update([
                'tag_name' => $name,
                'description' => $desc,
            ]);

            if ($tagRes) {
                return response()->json([
                    'status' => true,
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'error' => 'Nhãn không tồn tại',
            'request' => $request->all(),

        ]);
    }

    public function deleteTag($tagId)
    {

        $checkTag = Tag::find($tagId);
        if ($checkTag) {
            $checkTag->delete();
            return response()->json([
                'status' => true
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }

    public function user($tokenId)
    {
        $verifiedIdToken =  $this->auth->verifyIdToken($tokenId);
        $userId = $verifiedIdToken->claims()->get('sub');
        return $userId;
    }
}
