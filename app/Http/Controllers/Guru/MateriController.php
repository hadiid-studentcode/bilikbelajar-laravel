<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Materi;
use App\Models\tujuanPembelajaran;
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
        $tujuanPembelajaran = TujuanPembelajaran::all();

        return view('guru.materi.show', compact('materi', 'kelas', 'title', 'tujuanPembelajaran'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required',
                'kelas' => 'required',
                'image' => 'nullable|image',
                'content' => 'required',
                'file' => 'nullable|file',
                'video' => 'nullable|file',
            ]);

            $data = [
                'guru_id' => Guru::where('user_id', Auth::id())->value('id'),
                'nama' => $validated['nama'],
                'kelas' => $validated['kelas'],
                'image' => $request->hasFile('image') ? $request->file('image')->store('materi/image') : null,
                'deskripsi' => $validated['content'],
                'file' => $request->hasFile('file') ? $request->file('file')->store('materi/file') : null,
                'video' => $request->hasFile('video') ? $request->file('video')->store('materi/video') : null,
            ];

            Materi::create($data);

            return redirect()->back()->with('success', 'Materi berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Materi gagal ditambahkan');
        }
    }

    public function storeTp(Request $request)
    {
        try {
            $request->validate([
                'tujuan_pembelajaran' => 'required',
                'materi_id' => 'required',
            ]);

            TujuanPembelajaran::create([
                'deskripsi' => $request->input('tujuan_pembelajaran'),
                'materi_id' => $request->input('materi_id'),
            ]);

            return redirect()->back()->with('success', 'Tujuan Pembelajaran berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Tujuan Pembelajaran gagal ditambahkan');
        }
    }

    public function updateTp(Request $request, $tp_id)
    {
        try {
            $request->validate([
                'tujuan_pembelajaran' => 'required',
            ]);

            $tujuanPembelajaran = TujuanPembelajaran::find($tp_id);
            $tujuanPembelajaran->update([
                'deskripsi' => $request->input('tujuan_pembelajaran'),
            ]);

            return redirect()->back()->with('success', 'Tujuan Pembelajaran berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Tujuan Pembelajaran gagal diupdate');
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
