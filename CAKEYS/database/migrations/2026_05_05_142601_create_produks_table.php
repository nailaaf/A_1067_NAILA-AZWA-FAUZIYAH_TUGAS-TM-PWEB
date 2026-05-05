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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();

            $table->string('kode_produk')->unique();
            $table->string('nama_produk');
            $table->enum('kategori', ['cake', 'brownies', 'cupcake']);
            $table->decimal('harga', 10, 2);
            $table->integer('stok');
            $table->boolean('is_available')->default(true);
            $table->string('gambar')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
