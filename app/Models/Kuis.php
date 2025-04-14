<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    /** @use HasFactory<\Database\Factories\KuisFactory> */
    use HasFactory;
    protected $table = 'kuis';
    protected $guarded = ['id'];
}
