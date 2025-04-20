<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;

class MateriController extends Controller
{
    protected $title = 'Materi';
    public function show($id)
    {
        $title = $this->title;
        $materi = Materi::find($id);

        return view('siswa.materi.show', compact('materi', 'title'));
    }
}
