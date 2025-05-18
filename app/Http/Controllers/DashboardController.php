<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function umpegdashboard()
    {
        return view('umpeg.dashboard');
    }

    public function umpegriwayat()
    {
        return view('umpeg.riwayat');
    }

}
