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
                'video_file' => 'nullable|file',
                'video_url' => 'nullable',
            ]);
            if ($request->hasFile('video_file')) {
                $video = $request->file('video_file')->store('materi/video');
            }

            if ($request->video_url) {
                $video = $request->video_url;
            }

            $data = [
                'guru_id' => Guru::where('user_id', Auth::id())->value('id'),
                'nama' => $validated['nama'],
                'kelas' => $validated['kelas'],
                'image' => $request->hasFile('image') ? $request->file('image')->store('materi/image') : null,
                'deskripsi' => $validated['content'],
                'file' => $request->hasFile('file') ? $request->file('file')->store('materi/file') : null,
                'video' => $video ?? null,
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
                'video_url' => 'nullable',
                'video_file' => 'nullable|file',
                'image' => 'nullable|image',
            ]);

            $materi = Materi::find($id);

            if ($request->hasFile('file')) {
                // delete old file if exists
                if ($materi->file) {
                    Storage::delete($materi->file);
                }
                $file = $request->file('file')->store('materi/file');
            } else {
                $file = $materi->file;
            }

            // Periksa apakah ada file video baru yang diunggah
            if ($request->hasFile('video_file')) {
                // Hapus video lama jika ada dan bukan URL
                if ($materi->video && !filter_var($materi->video, FILTER_VALIDATE_URL)) {
                    Storage::disk('public')->delete($materi->video);
                }

                // Simpan file video baru
                $video = $request->file('video_file')->store('materi/video', 'public');
            } elseif ($request->filled('video_url')) {
                // Jika URL video baru diberikan, hapus video lama (file fisik atau URL)
                if ($materi->video && !filter_var($materi->video, FILTER_VALIDATE_URL)) {
                    Storage::disk('public')->delete($materi->video);
                }

                // Simpan URL video baru
                $video = $request->video_url;
            } else {
                // Jika tidak ada perubahan video, tetap gunakan video lama
                $video = $materi->video;
            }




            if ($request->hasFile('image')) {
                // delete old image if exists
                if ($materi->image) {
                    Storage::delete($materi->image);
                }
                $image = $request->file('image')->store('materi/image');
            } else {
                $image = $materi->image;
            }

            $materi->update([
                'nama' => $request->input('nama'),
                'kelas' => $request->input('kelas'),
                'deskripsi' => $request->input('editContent'),
                'file' => $file,
                'video' => $video,
                'image' => $image,
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
