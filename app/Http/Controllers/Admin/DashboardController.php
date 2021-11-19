<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\ReportPosts;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.layout.dashboard', ['title' => 'Tổng quan']);
    }



    // api
    public function reportGeneral()
    {
        //post
        // $dt = Carbon::now();

        // $month = $dt->subYear(); 

        try {
            $posts = $this->reportPost();
            $users = $this->reportUser();
            $reportPost = $this->reportPostReport();
            $reportTag = $this->reportTags();
            return response()->json([
                'status' => true,
                'posts' => $posts,
                'users' => $users,
                'reportPost' =>  $reportPost,
                'reportTag' => $reportTag
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'error' => 'Không thể lấy dữ liệu'
            ]);
        }






        // Tag
    }

    public function reportPost()
    {
        $dt = Carbon::now();
        $posts = Post::select('id', 'title', 'created_at')->where('created_at', '>', $dt->subYear())->count();

        return $posts;
    }

    public function reportUser()
    {
        $dt = Carbon::now();
        $users = User::select('id')->where('created_at', '>', $dt->subYear())->count();

        return $users;
    }

    public function reportPostReport()
    {
        $dt = Carbon::now();
        $reportPost = ReportPosts::where('created_at', '>', $dt->subYear())->count();

        return $reportPost;
    }

    public function reportTags()
    {
        $dt = Carbon::now();
        $tags = Tag::where('created_at', '>', $dt->subYear())->count();

        return $tags;
    }

    public function dataQuantityUser($amountDay = 10)
    {
        $dt = Carbon::tomorrow();

        $dates = [];
        $quantityUsers = [];
        for ($i = 0; $i < $amountDay; $i++) {
            array_push($dates, $dt->subDays(1)->format('d-m-Y'));
        }
        $dates = array_reverse($dates);

        // $users = User::where('register_at');


        foreach ($dates as $key => $date) {
            $dateTime = ' ';
            $lifeTimeAlive = 60; //seconds
            $quantity =  Cache::remember('user_register_at' . $date, $lifeTimeAlive, function () use ($date) {
                $dateTime = Carbon::createFromFormat('d-m-Y', $date)->setTime(23, 59, 59)->toDateTimeString();
                return User::where('register_at', '<=', $dateTime)->count();
            });

            array_push($quantityUsers, $quantity);
        }


        return response()->json([
            'lables' => $dates,
            'data' => $quantityUsers,
            // 'test' => $dateTemp->setDate($date->year,$date->month,$date->day)->toDateTimeString()
        ]);
    }
}
