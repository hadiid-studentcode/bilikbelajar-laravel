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

    public function evaluasi()
    {
        return $this->belongsTo(Evaluasi::class);
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
