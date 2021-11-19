<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageReportPostController extends Controller
{
    public function index()
    {
       return view('admin.layout.report-post', ['title' => 'Quản lý báo cáo']);
    }
}
