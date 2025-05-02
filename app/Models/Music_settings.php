<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music_settings extends Model
{
    /** @use HasFactory<\Database\Factories\MusicSettingsFactory> */
    use HasFactory;

    protected $table = 'music_settings';

    protected $guarded = ['id'];
}
