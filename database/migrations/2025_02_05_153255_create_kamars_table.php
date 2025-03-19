<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kamar')->unique();
            $table->unsignedBigInteger('tipe_kamar');
            $table->integer('lantai');
            $table->enum('status', ['tersedia', 'terisi', 'perbaikan']);
            $table->string('image')->nullable(); // Added image field
            $table->foreign('tipe_kamar')->references('id')->on('tipe_kamars');
            $table->timestamps();
        });
    }

    /**a
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};