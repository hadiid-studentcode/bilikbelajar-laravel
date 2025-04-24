<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{

    protected $title = 'Evaluasi';

    public function index()
    {
        $title = $this->title;
        return view('guru.materi.evaluasi.index', compact('title'));
    }
}
