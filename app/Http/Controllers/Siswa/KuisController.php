<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\jawabanKuis;
use App\Models\Kuis;
use App\Models\nilaiKuis;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    protected $title = 'Kuis';

    public function index($materi_id)
    {
        $title = $this->title;
        if (! session()->has('siswa')) {
            return redirect()->route('siswa.login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $kuis = Kuis::where('materi_id', $materi_id)->get();
        if ($kuis->count() == 0) {
            return redirect()->route('siswa.dashboard.index')->with('error', 'Kuis tidak ditemukan');
        }

        $nilaiKuis = nilaiKuis::where('siswa_id', session('siswa')->id)
            ->where('materi_id', $materi_id)
            ->first();

        if ($nilaiKuis) {
            $jawabanKuis = jawabanKuis::with('kuis')
                ->where('siswa_id', session('siswa')->id)
                ->whereIn('kuis_id', $kuis->pluck('id'))
                ->get();

            $nilaiKuis->jawaban_kuis = $jawabanKuis;
        }

        return view('siswa.kuis.index', compact('materi_id', 'title', 'kuis', 'nilaiKuis'));
    }

    public function store(Request $request)
    {
        if (! session()->has('siswa')) {
            return redirect()->route('siswa.login')->with('error', 'Silahkan login terlebih dahulu');
        }

        try {
            $answers = json_decode($request->answers, true);
            $question_ids = json_decode($request->question_ids);
            $siswa_id = session('siswa')->id;

            // Count not answered questions more efficiently
            $not_answered = collect($answers)->filter(fn ($answer) => empty($answer['answer']))->count();

            // Bulk insert answers
            $jawaban_data = collect($answers)->map(function ($answer) use ($siswa_id) {
                return [
                    'siswa_id' => $siswa_id,
                    'kuis_id' => $answer['question_id'],
                    'jawaban' => $answer['answer'],
                    'poin' => $answer['points'],
                ];
            })->toArray();

            jawabanKuis::insert($jawaban_data);

            // Create nilai kuis
            nilaiKuis::create([
                'materi_id' => $request->materi_id,
                'siswa_id' => $siswa_id,
                'total_nilai' => $request->score,
                'jumlah_benar' => $request->correct_answers,
                'jumlah_salah' => count($question_ids) - $request->correct_answers,
                'jumlah_tidak_dijawab' => $not_answered,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Jawaban berhasil disimpan',
                'score' => $request->score,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Jawaban gagal disimpan',
            ], 500);
        }
    }
}
