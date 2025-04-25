<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Evaluasi;
use App\Models\Materi;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    protected $title = 'Evaluasi';

    public function index($materi_id)
    {

        $title = $this->title;
        $materi = Materi::select('kelas')->where('id', $materi_id)->first();
        $evaluasi = Evaluasi::where('materi_id', $materi_id)->get();

        return view('guru.materi.evaluasi.index', compact('title', 'materi_id', 'materi', 'evaluasi'));
    }

    public function store(Request $request, $materi_id)
    {

        try {
            $data = [];
            foreach ($request->soal as $key => $soal) {
                $data[] = [
                    'materi_id' => $materi_id,
                    'soal' => $soal,
                    'jawaban' => $request->jawaban_contoh[$key],
                    'poin' => $request->bobot[$key],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            Evaluasi::insert($data);

            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            dd($th->getMessage());

            return redirect()->back()->with('error', 'Data gagal disimpan');
        }
    }

    public function update(Request $request, $materi_id)
    {
        try {
            $data = [];
            foreach ($request->soal as $key => $soal) {
                $data[] = [
                    'materi_id' => $materi_id,
                    'soal' => $soal,
                    'jawaban' => $request->jawaban_contoh[$key],
                    'poin' => $request->bobot[$key],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            Evaluasi::where('materi_id', $materi_id)->delete();
            Evaluasi::insert($data);

            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data gagal disimpan');
        }
    }

    public function destroy($materi_id)
    {
        try {
            Evaluasi::where('materi_id', $materi_id)->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }
    }
}
