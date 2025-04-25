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
        Schema::create('jawaban_evaluasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluasi_id')->references('id')->on('evaluasis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('siswa_id')->references('id')->on('siswas')->onDelete('cascade')->onUpdate('cascade');
            $table->text('jawaban')->nullable();
            $table->integer('nilai')->default(0)->nullable();
            $table->enum('status', ['benar', 'salah'])->default('salah')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_evaluasis');
    }
};
