<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\capaianPembelajaran;
use App\Models\tujuanPembelajaran;
use Illuminate\Http\Request;

class CapaianTujuanPembelajaranController extends Controller
{
  public function index()
  {
    return view('guru.cp_tp.index');
  }

  public function store(Request $request)
  {


    try {
      $request->validate([
        'tp' => 'required',
        'cp' => 'required',

      ]);

      tujuanPembelajaran::create([
        'dekripsi' => $request->tp,
      ]);
      capaianPembelajaran::create([
        'dekripsi' => $request->cp,
      ]);

      return back()->with('success', 'Berhasil menambahkan capaian tujuan pembelajaran');
    } catch (\Throwable $th) {
      return back()->with('error', 'Gagal menambahkan capaian tujuan pembelajaran');
    }
  }
}
