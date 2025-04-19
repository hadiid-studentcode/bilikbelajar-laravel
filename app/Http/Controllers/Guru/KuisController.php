<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    protected $title = 'Kuis';

    public function index($materi_id)
    {

        $title = $this->title;
        $kuis = Kuis::where('materi_id', $materi_id)->get();
       

        return view('guru.materi.kuis.index', compact('title', 'materi_id', 'kuis'));
    }

    public function store(Request $request, $materi_id)
    {
        try {
            $kuisData = array_map(function ($soal) use ($materi_id) {
                return [
                    'materi_id' => $materi_id,
                    'pertanyaan' => $soal['pertanyaan'],
                    'poin_benar' => $soal['bobot'],
                    'jawaban_a' => $soal['opsi']['a'],
                    'jawaban_b' => $soal['opsi']['b'],
                    'jawaban_c' => $soal['opsi']['c'],
                    'jawaban_d' => $soal['opsi']['d'],
                    'jawaban_e' => $soal['opsi']['e'],
                    'jawaban_benar' => strtolower($soal['jawaban_benar']),
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }, $request->soal);

            Kuis::insert($kuisData);

            return back()->with('success', 'Kuis berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan kuis: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $materi_id)
    {
        try {
            Kuis::where('materi_id', $materi_id)->delete();

            $kuisData = array_map(function ($soal) use ($materi_id) {
                return [
                    'materi_id' => $materi_id,
                    'pertanyaan' => $soal['pertanyaan'],
                    'poin_benar' => $soal['bobot'],
                    'jawaban_a' => $soal['opsi']['a'],
                    'jawaban_b' => $soal['opsi']['b'],
                    'jawaban_c' => $soal['opsi']['c'],
                    'jawaban_d' => $soal['opsi']['d'],
                    'jawaban_e' => $soal['opsi']['e'],
                    'jawaban_benar' => strtolower($soal['jawaban_benar']),
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }, $request->soal);

            Kuis::insert($kuisData);

            return back()->with('success', 'Kuis berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui kuis: ' . $e->getMessage());
        }
    }
    public function destroy($materi_id)
    {
        try {
            Kuis::where('materi_id', $materi_id)->delete();
            return back()->with('success', 'Kuis berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus kuis: ' . $e->getMessage());
        }
    }
}
