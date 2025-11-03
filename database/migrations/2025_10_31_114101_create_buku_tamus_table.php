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
        Schema::create('buku_tamus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('role', ['ortu', 'umum']);
            $table->string('instansi')->nullable();
            $table->text('alamat');
            $table->string('kontak')->nullable();
            $table->foreignId('siswa_id')->nullable()->constrained('siswas')->onDelete('set null');
            $table->foreignId('jabatan_id')->nullable()->constrained('jabatans')->onDelete('set null');
            $table->foreignId('pegawai_id')->nullable()->constrained('pegawais')->onDelete('set null');
            $table->text('keperluan');
            $table->string('foto_tamu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_tamus');
    }
};
