<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\CapaianPembelajaran;
use Illuminate\Http\Request;

class CapaianPembelajaranController extends Controller
{
    protected $title = 'Capaian Pembelajaran';

    public function index()
    {

        $title = $this->title;
        $capaianKelas10 = capaianPembelajaran::where('kelas', '10')->first();
        $capaianKelas11_12 = capaianPembelajaran::where('kelas', '11')->orWhere('kelas', '12')->first();

        return view('guru.cp.index', compact('capaianKelas10', 'title'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([

                'cp' => 'required',
                'kelas' => 'required|in:10,11,12',

            ]);

            CapaianPembelajaran::create([
                'deskripsi' => $request->cp,
                'kelas' => $request->kelas,
            ]);

            return back()->with('success', 'Berhasil menambahkan Capaian pembelajaran');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal menambahkan capaian tujuan pembelajaran');
        }
    }

    public function update(Request $request, $kelas)
    {
        try {
            $request->validate([
                'cp' => 'required',
            ]);

            $query = CapaianPembelajaran::query();

            if ($kelas === '1112') {
                $query->whereIn('kelas', ['11', '12']);
            } else {
                $query->where('kelas', $kelas);
            }

            $query->update(['deskripsi' => $request->cp]);

            return back()->with('success', 'Berhasil mengubah Capaian Pembelajaran');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal mengubah capaian tujuan pembelajaran');
        }
    }

    public function destroy($kelas)
    {
        try {
            $query = CapaianPembelajaran::query();

            if ($kelas === '1112') {
                $query->whereIn('kelas', ['11', '12']);
            } else {
                $query->where('kelas', $kelas);
            }

            $query->delete();

            return back()->with('success', 'Berhasil menghapus Capaian Pembelajaran');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal menghapus capaian tujuan pembelajaran');
        }
    }
}
