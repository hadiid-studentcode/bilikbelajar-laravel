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

        return view('guru.materi.kuis.index', compact('title', 'materi_id'));
    }

    public function store(Request $request, $materi_id)
    {
        try {
            dd($request->all());

            foreach ($request->soal as $soal) {
                Kuis::create([
                    'materi_id' => $materi_id,
                    'pertanyaan' => $soal['pertanyaan'],
                    'poin_benar' => $soal['bobot'],
                    'jawaban_a' => $soal['opsi']['a'],
                    'jawaban_b' => $soal['opsi']['b'],
                    'jawaban_c' => $soal['opsi']['c'],
                    'jawaban_d' => $soal['opsi']['d'],
                    // 'jawaban_e' => $soal['opsi']['e'],
                    'jawaban_benar' => strtolower($soal['jawaban_benar'])
                ]);
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
