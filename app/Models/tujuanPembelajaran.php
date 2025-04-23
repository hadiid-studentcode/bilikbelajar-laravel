<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TujuanPembelajaran extends Model
{
    /** @use HasFactory<\Database\Factories\TujuanPembelajaranFactory> */
    use HasFactory;

    protected $table = 'tujuan_pembelajarans';

    protected $guarded = ['id'];

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id', 'id');
    }
}
