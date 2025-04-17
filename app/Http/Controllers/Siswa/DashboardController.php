<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\capaianPembelajaran;
use App\Models\Materi;
use App\Models\tujuanPembelajaran;

class DashboardController extends Controller
{
    public function index()
    {

        if (! session()->has('siswa')) {
            return redirect()->route('siswa.login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $materi = Materi::select('id', 'nama', 'kelas')->where('kelas', session()->get('siswa')->kelas)->get();
        $tujuanPembelajaran = tujuanPembelajaran::first();
        $capaianPembelajaran = capaianPembelajaran::first();

        return view('siswa.dashboard.index', compact('materi', 'tujuanPembelajaran', 'capaianPembelajaran'));
    }

    public function show() {}
}
