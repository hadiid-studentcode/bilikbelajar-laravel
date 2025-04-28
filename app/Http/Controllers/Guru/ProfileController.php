<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $title = 'Profile';
    public function index()
    {
        $title = $this->title;
        return view('guru.profile.index', compact('title'));
    }
}
