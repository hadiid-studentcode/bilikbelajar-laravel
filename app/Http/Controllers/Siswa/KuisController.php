<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\jawabanKuis;
use App\Models\Kuis;
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

        return view('siswa.kuis.index', compact('materi_id', 'title','kuis'));
    }

    public function submit(Request $request)
    {

        dd($request->all());

        jawabanKuis::create([
            'siswa_id' => session('siswa')->id,
            'kuis_id' => $request->kuis_id,
            'jawaban' => $request->jawaban,
            'poin' => $request->poin,
        ]);
     


    }
}
