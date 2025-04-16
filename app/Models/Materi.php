<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    /** @use HasFactory<\Database\Factories\MateriFactory> */
    use HasFactory;

    protected $table = 'materis';

    protected $guarded = ['id'];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
