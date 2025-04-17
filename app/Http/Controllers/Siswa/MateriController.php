<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;

class MateriController extends Controller
{
    public function show($id)
    {
        $materi = Materi::find($id);

        return view('siswa.materi.show', compact('materi'));
    }
}
