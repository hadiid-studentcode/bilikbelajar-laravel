<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {

        if (session('siswa')) {
            return redirect()->route('siswa.dashboard.index');
        }

        return view('auth.siswa.login');
    }

    public function login(Request $request)
    {

        try {
            $request->validate([
                'nama' => 'required',
                'asalSekolah' => 'required',
                'kelas' => 'required',
            ]);

            $siswa = Siswa::where('nama', $request->nama)
                ->where('asal_sekolah', $request->asalSekolah)
                ->where('kelas', $request->kelas)
                ->first();

            if ($siswa) {
                $request->session()->regenerate();

                $request->session()->put('siswa', $siswa);

                return redirect()->route('siswa.dashboard.index')->with('success', 'Login Berhasil');
            } else {
                $siswaBaru = Siswa::create([
                    'nama' => $request->nama,
                    'asal_sekolah' => $request->asalSekolah,
                    'kelas' => $request->kelas,
                ]);
                $request->session()->regenerate();
                $request->session()->put('siswa', $siswaBaru);

                return redirect()->route('siswa.dashboard.index')->with('success', 'Login Berhasil');
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function logout()
    {
        try {

            session()->forget('siswa');
            session()->flush();

            return redirect('/');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
