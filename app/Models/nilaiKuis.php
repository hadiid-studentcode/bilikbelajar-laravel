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
}
