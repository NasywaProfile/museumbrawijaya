<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa yang pesan
            $table->string('category')->default('Umum'); // Kategori Tiket
            $table->date('visit_date'); // Tanggal Kunjung
            $table->integer('quantity'); // Jumlah
            $table->decimal('total_price', 10, 2); // Total Harga
            $table->string('status')->default('pending');
            $table->string('payment_proof')->nullable(); // Lokasi file gambar bukti
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
