<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;

class EvaluasiController extends Controller
{
    protected $title = 'Evaluasi';

    public function index($materi_id)
    {
       
        $title = $this->title;
        $materi = Materi::select('kelas')->where('id', $materi_id)->first();

        return view('guru.materi.evaluasi.index', compact('title','materi_id', 'materi'));
    }
}
