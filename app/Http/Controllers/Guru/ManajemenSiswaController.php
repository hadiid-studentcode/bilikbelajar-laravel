<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class ManajemenSiswaController extends Controller
{
    protected $title = 'Manajemen Siswa';

    public function index()
    {

        $title = $this->title;
        $siswa = Siswa::all();

        return view('guru.siswa.index', compact('title', 'siswa'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'asal_sekolah' => 'required',
                'kelas' => 'required|in:10,11,12',
            ]);

            Siswa::create($request->all());

            return back()->with('success', 'Siswa berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Siswa gagal ditambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'asal_sekolah' => 'required',
                'kelas' => 'required|in:10,11,12',
            ]);

            $siswa = Siswa::findOrFail($id);
            $siswa->update($request->all());

            return back()->with('success', 'Siswa berhasil diperbarui');
        } catch (\Exception) {
            return back()->with('error', 'Siswa gagal diperbarui');
        }
    }

    public function destroy($id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->delete();

            return back()->with('success', 'Siswa berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Siswa gagal dihapus');
        }
    }
}
