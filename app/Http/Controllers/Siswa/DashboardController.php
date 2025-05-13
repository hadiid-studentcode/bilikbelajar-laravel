<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\capaianPembelajaran;
use App\Models\Materi;

class DashboardController extends Controller
{
    protected $title = 'Dashboard';

    public function index()
    {

        $title = $this->title;

        if (! session()->has('siswa')) {
            return redirect()->route('siswa.login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $materi = Materi::select('id', 'nama', 'kelas', 'image')->where('kelas', session()->get('siswa')->kelas)->get();
        $capaianPembelajaran = capaianPembelajaran::where('kelas', session()->get('siswa')->kelas)->first();

        return view('siswa.dashboard.index', compact('materi', 'capaianPembelajaran', 'title'));
    }

    public function show() {}
}
