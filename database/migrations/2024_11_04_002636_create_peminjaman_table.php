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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('kode_peminjaman')->unique();
            $table->string('kode_detail_peminjaman');
            $table->string('nomor_surat');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_kembali');
            $table->string('peminjam');
            $table->string('petugas');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
