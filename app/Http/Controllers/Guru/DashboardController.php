<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\NilaiEvaluasi;
use App\Models\nilaiKuis;
use App\Models\Siswa;

class DashboardController extends Controller
{
    protected $title = 'Dashboard';

    public function index()
    {
        $data = [
            'title' => $this->title,
            'totalSiswa' => Siswa::count(),
            'totalSekolah' => Siswa::distinct('asal_sekolah')->count('asal_sekolah'),
        ];

        $getTopScores = function ($model, $kelas) {
            return $model::with('siswa')
                ->join('siswas', $model->getTable().'.siswa_id', '=', 'siswas.id')
                ->where('siswas.kelas', $kelas)
                ->select('siswa_id')
                ->selectRaw('SUM(total_nilai) as total_nilai')
                ->groupBy('siswa_id')
                ->orderByDesc('total_nilai')
                ->limit(3)
                ->get();
        };

        foreach (['10', '11', '12'] as $kelas) {
            $data["KuisKelas{$kelas}"] = $getTopScores(new nilaiKuis, $kelas);
            $data["EvaluasiKelas{$kelas}"] = $getTopScores(new NilaiEvaluasi, $kelas);
        }

        return view('guru.dashboard.index', $data);
    }
}
