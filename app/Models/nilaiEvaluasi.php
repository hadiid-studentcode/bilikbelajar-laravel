<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiEvaluasi extends Model
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

    public function detailNilai()
    {
        return $this->hasManyThrough(
            JawabanEvaluasi::class,
            Evaluasi::class,
            'materi_id', // Foreign key on evaluasis table
            'evaluasi_id', // Foreign key on jawaban_evaluasis table
            'materi_id', // Local key on nilai_evaluasis table
            'id' // Local key on evaluasis table
        )->where('jawaban_evaluasis.siswa_id', $this->siswa_id);
    }
}
