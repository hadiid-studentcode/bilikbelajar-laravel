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
        Schema::create('materis', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('guru_id')->references('id')->on('gurus')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('kelas', [10, 11, 12]);
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('file')->nullable();
            $table->string('video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};
