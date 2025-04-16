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
        $capaian = capaianPembelajaran::first();
        $tujuan = tujuanPembelajaran::first();

        return view('guru.cp_tp.index', compact('capaian', 'tujuan'));
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

    public function update(Request $request, $capaian, $tujuan)
    {
        try {
            $request->validate([
                'tp' => 'required',
                'cp' => 'required',
            ]);

            $capaian = capaianPembelajaran::findOrFail($capaian);
            $tujuan = tujuanPembelajaran::findOrFail($tujuan);

            $capaian->update([
                'dekripsi' => $request->cp,
            ]);
            $tujuan->update([
                'dekripsi' => $request->tp,
            ]);

            return back()->with('success', 'Berhasil mengubah capaian tujuan pembelajaran');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal mengubah capaian tujuan pembelajaran');
        }
    }

    public function destroy($cp, $tp)
    {
        try {
            $capaian = capaianPembelajaran::findOrFail($cp);
            $tujuan = tujuanPembelajaran::findOrFail($tp);

            $capaian->delete();
            $tujuan->delete();

            return back()->with('success', 'Berhasil menghapus capaian tujuan pembelajaran');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal menghapus capaian tujuan pembelajaran');
        }
    }
}
