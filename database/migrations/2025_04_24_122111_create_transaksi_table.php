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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_barang')->constrained('barang')->onDelete('cascade');
        
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
        
            $table->time('jam_mulai');
            $table->time('jam_selesai'); // Batas waktu pengembalian
            $table->time('jam_dikembalikan')->nullable(); // Real jam kembali
        
            $table->string('status', 20)->default('dipinjam'); // Bisa: dipinjam, selesai, telat
            $table->timestamps(); // created_at, updated_at
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
