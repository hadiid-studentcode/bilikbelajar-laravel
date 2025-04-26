<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilaiKuis extends Model
{
    /** @use HasFactory<\Database\Factories\NilaiKuisFactory> */
    use HasFactory;

    protected $table = 'nilai_kuis';

    protected $guarded = ['id'];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function jawaban_kuis()
    {
        return $this->hasMany(jawabanKuis::class, 'siswa_id', 'siswa_id')
            ->whereHas('kuis', function ($query) {
                $query->where('materi_id', $this->materi_id);
            });
    }
}
