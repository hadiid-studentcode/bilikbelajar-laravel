<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;

class EvaluasiController extends Controller
{
    protected $title = 'Evaluasi';

    public function index()
    {
        $title = $this->title;

        return view('guru.materi.evaluasi.index', compact('title'));
    }
}
