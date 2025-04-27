<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::firstOrCreate([
            'username' => 'guru',
            'password' => bcrypt('guru'),
        ]);

        Guru::factory()->create([
            'user_id' => $user->id,
            'nama' => 'Guru',
            'mapel' => 'Biologi',
        ]);


        $path_file = storage_path('app/public/materi/file');
        $path_video = storage_path('app/public/materi/video');

        if (is_dir($path_file)) {
            array_map('unlink', glob("$path_file/*.*"));
        }

        if (is_dir($path_video)) {
            array_map('unlink', glob("$path_video/*.*"));
        }
    }
}
