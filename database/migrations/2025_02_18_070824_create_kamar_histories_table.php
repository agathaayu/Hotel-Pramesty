<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kamar_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kamar_id')->constrained()->onDelete('cascade');
            $table->string('status_lama');
            $table->string('status_baru');
            $table->text('keterangan')->nullable();
            $table->foreignId('diubah_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kamar_histories');
    }
};