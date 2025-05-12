<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class capaianPembelajaran extends Model
{
    /** @use HasFactory<\Database\Factories\CapaianPembelajaranFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'capaian_pembelajarans';
}
