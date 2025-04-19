<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    public function index()
    {
        $kelas = [
            (object) [
                'id' => '1',
                'nama' => 'Kelas 10',
                'value' => '10',
            ],
            (object) [
                'id' => '2',
                'nama' => 'Kelas 11',
                'value' => '11',
            ],
            (object) [
                'id' => '3',
                'nama' => 'Kelas 12',
                'value' => '12',
            ],
        ];

        return view('guru.materi.index', compact('kelas'));
    }

    public function kelas($kelas)
    {
        $materi = Materi::where('kelas', $kelas)->get();

        return view('guru.materi.show', compact('materi', 'kelas'));
    }

    public function store(Request $request)
    {

        try {
            $request->validate([
                'nama' => 'required',
                'kelas' => 'required',
                'deskripsi' => 'nullable',
                'file' => 'nullable',
                'video' => 'nullable',
            ]);

            $file = $request->file('file')->store('materi/file');
            $video = $request->file('video')->store('materi/video');

            Materi::create([
                'guru_id' => Guru::where('user_id', Auth::user()->id)->first()->id,
                'nama' => $request->input('nama'),
                'kelas' => $request->input('kelas'),
                'deskripsi' => $request->input('deskripsi'),
                'file' => $file,
                'video' => $video,
            ]);

            return redirect()->back()->with('success', 'Materi berhasil ditambahkan');
        } catch (\Throwable $th) {
            dd($th->getMessage());

            return redirect()->back()->with('error', 'Materi gagal ditambahkan');
        }
    }
}
