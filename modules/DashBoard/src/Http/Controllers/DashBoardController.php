<?php

namespace Modules\DashBoard\src\Http\Controllers;

use App\Http\Controllers\Controller;

class DashBoardController extends Controller
{
    public function index()
    {
        $pageTitle = "Trang chủ";
        return view('dashboard::dashboard', compact('pageTitle'));
    }
}