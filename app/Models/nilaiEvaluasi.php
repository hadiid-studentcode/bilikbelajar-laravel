<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilaiEvaluasi extends Model
{
    /** @use HasFactory<\Database\Factories\NilaiEvaluasiFactory> */
    use HasFactory;

    protected $table = 'nilai_evaluasis';
    protected $guarded = ['id'];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
