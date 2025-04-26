<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nilai_evaluasis', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('materi_id')->references('id')->on('materis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('siswa_id')->references('id')->on('siswas')->onDelete('cascade')->onUpdate('cascade');
            $table->float('total_nilai')->default(0);
            // $table->integer('jumlah_benar')->default(0);
            // $table->integer('jumlah_salah')->default(0);
            // $table->integer('jumlah_tidak_dijawab')->default(0);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_evaluasis');
    }
};
