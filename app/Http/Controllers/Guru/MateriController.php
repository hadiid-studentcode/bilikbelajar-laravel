<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;

class MateriController extends Controller
{
    public function index()
    {
        return view('guru.materi.index');
    }
}
