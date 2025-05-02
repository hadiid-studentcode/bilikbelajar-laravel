<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        dd($siswa);

        return view('guru.siswa.index', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'asal_sekolah' => 'required',
            'kelas' => 'required|in:10,11,12',
        ]);

        Siswa::create($request->all());

        return redirect()->route('guru.siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required',
            'asal_sekolah' => 'required',
            'kelas' => 'required|in:10,11,12',
        ]);

        $siswa->update($request->all());

        return redirect()->route('guru.siswa.index')->with('success', 'Siswa berhasil diperbarui');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('guru.siswa.index')->with('success', 'Siswa berhasil dihapus');
    }
}
