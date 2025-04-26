<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Evaluasi;
use App\Models\JawabanEvaluasi;
use App\Models\nilaiEvaluasi;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    protected $title = 'Evaluasi';

    public function index($materi_id)
    {

        $title = $this->title;
        $evaluasi = Evaluasi::where('materi_id', $materi_id)->get();

        if (! session()->has('siswa')) {
            return redirect()->route('siswa.login')->with('error', 'Silahkan login terlebih dahulu');
        }
        if ($evaluasi->count() == 0) {
            return redirect()->route('siswa.dashboard.index')->with('error', 'Evaluasi tidak ditemukan');
        }
        $nilaiEvaluasi = nilaiEvaluasi::where('siswa_id', session('siswa')->id)
            ->where('materi_id', $materi_id)
            ->first();


        return view('siswa.evaluasi.index', compact('materi_id', 'title', 'evaluasi', 'nilaiEvaluasi'));
    }

    public function store(Request $request)
    {

        try {
            $request->validate([
                'materi_id' => 'required|exists:materis,id',
                'answers' => 'required|string',
                'question_ids' => 'required|string',
            ]);

            $answers = json_decode($request->answers, true);
            $questionIds = json_decode($request->question_ids, true);

            foreach ($answers as $answer) {
                JawabanEvaluasi::create([
                    'evaluasi_id' => $answer['question_id'],
                    'siswa_id' => session('siswa')->id,
                    'jawaban' => $answer['answer'],
                ]);
            }

            nilaiEvaluasi::create([
                'materi_id' => $request->materi_id,
                'siswa_id' => session('siswa')->id,
            ]);

            return response()->json(['message' => 'Evaluasi berhasil disimpan']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Evaluasi gagal disimpan: '.$th->getMessage()], 500);
        }
    }
}
