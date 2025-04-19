<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    protected $title = 'Kuis';
    public function index($materi_id)
    {

       

        $title = $this->title;
       return view('guru.materi.kuis.index', compact('title'));
    }
}
