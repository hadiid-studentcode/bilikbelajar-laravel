<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('guru.dashboard.index');
    }
}
