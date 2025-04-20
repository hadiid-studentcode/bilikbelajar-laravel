<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    protected $title = 'Materi';

    public function index()
    {
        $title = $this->title;

        return view('guru.materi.index', compact('title'));
    }

    public function kelas($kelas)
    {
        $title = $this->title;
        $materi = Materi::where('kelas', $kelas)->get();

        return view('guru.materi.show', compact('materi', 'kelas', 'title'));
    }

    public function store(Request $request)
    {

        try {
            $request->validate([
                'nama' => 'required',
                'kelas' => 'required',
                'content' => 'nullable',
                'file' => 'nullable',
                'video' => 'nullable',
            ]);
            $file = null;
            $video = null;

            if ($request->file('file')) {
                $file = $request->file('file')->store('materi/file');
            }
            if ($request->file('video')) {
                $video = $request->file('video')->store('materi/video');
            }

            Materi::create([
                'guru_id' => Guru::where('user_id', Auth::user()->id)->first()->id,
                'nama' => $request->input('nama'),
                'kelas' => $request->input('kelas'),
                'deskripsi' => $request->input('content'),
                'file' => $file,
                'video' => $video,
            ]);

            return redirect()->back()->with('success', 'Materi berhasil ditambahkan');
        } catch (\Throwable $th) {
            dd($th->getMessage());

            return redirect()->back()->with('error', 'Materi gagal ditambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'kelas' => 'required',
                'editContent' => 'nullable',
                'file' => 'nullable',
                'video' => 'nullable',
            ]);

            $materi = Materi::find($id);

            if ($request->hasFile('file')) {
                $file = $request->file('file')->store('materi/file');
            } else {
                $file = $materi->file;
            }

            if ($request->hasFile('video')) {
                $video = $request->file('video')->store('materi/video');
            } else {
                $video = $materi->video;
            }

            $materi->update([
                'nama' => $request->input('nama'),
                'kelas' => $request->input('kelas'),
                'deskripsi' => $request->input('editContent'),
                'file' => $file,
                'video' => $video,
            ]);

            return redirect()->back()->with('success', 'Materi berhasil diupdate');
        } catch (\Throwable $th) {
            dd($th->getMessage());

            return redirect()->back()->with('error', 'Materi gagal diupdate');
        }
    }

    public function destroy($id)
    {
        try {
            $materi = Materi::find($id);
            $materi->delete();
            // delete file if exists
            if ($materi->file) {
                Storage::delete($materi->file);
            }
            if ($materi->video) {
                Storage::delete($materi->video);
            }

            return redirect()->back()->with('success', 'Materi berhasil dihapus');
        } catch (\Throwable $th) {
            dd($th->getMessage());

            return redirect()->back()->with('error', 'Materi gagal dihapus');
        }
    }
}
