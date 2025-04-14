<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jawabanEvaluasi extends Model
{
    /** @use HasFactory<\Database\Factories\JawabanEvaluasiFactory> */
    use HasFactory;

    protected $table = 'jawaban_evaluasis';
    protected $guarded = ['id'];
}
