<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Evaluasi;
use App\Models\jawabanEvaluasi;
use App\Models\Materi;
use App\Models\NilaiEvaluasi;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    protected $title = 'Evaluasi';

    public function index($materi_id)
    {

        $title = $this->title;
        $evaluasi = Evaluasi::where('materi_id', $materi_id)->get();
        $nilaiEvaluasi = nilaiEvaluasi::with(['siswa', 'materi'])
            ->where('materi_id', $materi_id)
            ->get();
        $jawabanEvaluasi = jawabanEvaluasi::with(['evaluasi'])
            ->whereHas('evaluasi', function ($query) use ($materi_id) {
                $query->where('materi_id', $materi_id);
            })
            ->get();

        $materi = Materi::findOrFail($materi_id);

        return view('guru.materi.evaluasi.index', compact(
            'title',
            'materi_id',
            'materi',
            'evaluasi',
            'nilaiEvaluasi',
            'jawabanEvaluasi'
        ));
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
            NilaiEvaluasi::where('materi_id', $materi_id)->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }
    }

    public function destroyNilaiEvaluasi($nilaiEvaluasi_id)
    {
        try {
            $nilai = NilaiEvaluasi::findOrFail($nilaiEvaluasi_id);

            // Delete related answers first
            JawabanEvaluasi::where('siswa_id', $nilai->siswa_id)
                ->whereHas('evaluasi', function ($query) use ($nilai) {
                    $query->where('materi_id', $nilai->materi_id);
                })
                ->delete();

            // Then delete the nilai record
            $nilai->delete();

            return redirect()->back()->with('success', 'Jawaban evaluasi berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menghapus jawaban evaluasi');
        }
    }

    public function updateNilaiEvaluasi(Request $request, $nilaiEvaluasi_id)
    {

        try {
            $total_nilai = 0;
            foreach ($request->jawaban_id as $key => $id) {
                jawabanEvaluasi::where('id', $id)->update([
                    'nilai' => $request->nilai[$key],
                ]);
                $total_nilai += $request->nilai[$key];
            }

            NilaiEvaluasi::where('id', $nilaiEvaluasi_id)->update([
                'total_nilai' => $total_nilai,
                'catatan' => $request->catatan,
            ]);

            return back()->with('success', 'Nilai evaluasi berhasil diperbarui');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal memperbarui nilai evaluasi');
        }
    }
}
