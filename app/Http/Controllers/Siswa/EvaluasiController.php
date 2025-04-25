<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Evaluasi;
use App\Models\JawabanEvaluasi;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    protected $title = 'Evaluasi';

    public function index($materi_id)
    {

        $title = $this->title;
        $evaluasi = Evaluasi::where('materi_id', $materi_id)->get();

        return view('siswa.evaluasi.index', compact('materi_id', 'title', 'evaluasi'));
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

            return response()->json(['message' => 'Evaluasi berhasil disimpan']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Evaluasi gagal disimpan: '.$th->getMessage()], 500);
        }
    }
}
