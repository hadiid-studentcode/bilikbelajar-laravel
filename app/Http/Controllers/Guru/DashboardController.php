<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    protected $title = 'Dashboard';

    public function index()
    {
        $title = $this->title;

        return view('guru.dashboard.index', compact('title'));
    }
}
