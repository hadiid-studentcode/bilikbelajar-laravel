<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jawabanKuis extends Model
{
    /** @use HasFactory<\Database\Factories\JawabanKuisFactory> */
    use HasFactory;
    protected $table = 'jawaban_kuis';
    protected $guarded = ['id'];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class);
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
