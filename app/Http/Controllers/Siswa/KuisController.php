<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;

class KuisController extends Controller
{
    protected $title = 'Kuis';

    public function index($materi_id)
    {
        $title = $this->title;

        if (! session()->has('siswa')) {
            return redirect()->route('siswa.login')->with('error', 'Silahkan login terlebih dahulu');
        }

        return view('siswa.kuis.index', compact('materi_id', 'title'));
    }

    public function show($materi_id)
    {
        $title = $this->title;

        return view('siswa.kuis.show', compact('materi_id', 'title'));
    }
}
