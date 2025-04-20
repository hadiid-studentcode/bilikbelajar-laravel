<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kuis;

class KuisController extends Controller
{
    protected $title = 'Kuis';

    public function index($materi_id)
    {
        $title = $this->title;

        if (! session()->has('siswa')) {
            return redirect()->route('siswa.login')->with('error', 'Silahkan login terlebih dahulu');
        }
        $kuis = Kuis::where('materi_id', $materi_id)->get();

        return view('siswa.kuis.index', compact('materi_id', 'title','kuis'));
    }

    public function show($materi_id)
    {
        $title = $this->title;

        return view('siswa.kuis.show', compact('materi_id', 'title'));
    }
}
