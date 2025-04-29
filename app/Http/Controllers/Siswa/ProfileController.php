<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    protected $title = "Profile";

    public function index()
    {
        $title = $this->title;
        $siswa = session('siswa');
        return view('siswa.profile.index', compact('title', 'siswa'));
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_siswa' => 'required|string|max:255',
                'asal_sekolah' => 'required|string|max:255',
                'kelas' => 'required|string|max:255',
            ]);

            Siswa::where('id', $id)->update([
                'nama' => $request->nama_siswa,
                'asal_sekolah' => $request->asal_sekolah,
                'kelas' => $request->kelas,
            ]);

            // ubah session
            $siswaSession = session()->get('siswa');
            $siswaSession['nama'] = $request->nama_siswa;
            $siswaSession['asal_sekolah'] = $request->asal_sekolah;
            $siswaSession['kelas'] = $request->kelas;
            session()->put('siswa', $siswaSession);


            return back()->with('success', 'Profile Berhasil Diperbarui');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->with('error', 'Profile Gagal Diperbarui');
        }
    }
}
