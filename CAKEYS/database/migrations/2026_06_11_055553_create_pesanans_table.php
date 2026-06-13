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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('no_pesanan')->unique(); // Untuk nomor resi/struk (misal: ORD-001)
            $table->string('nama_pemesan');
            $table->string('no_wa');
            $table->string('metode_pengambilan');
            $table->text('alamat')->nullable();
            $table->date('tanggal_diperlukan');
            $table->integer('total_harga');
            $table->string('status')->default('Menunggu Pembayaran'); // Status awal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
