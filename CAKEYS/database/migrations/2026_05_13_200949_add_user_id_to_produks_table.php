<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            // Menambahkan foreign key user_id yang terhubung ke tabel users
            // cascadeOnDelete() artinya: kalau owner dihapus, semua produknya ikut terhapus
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            // Urutan drop harus constraint dulu, baru kolomnya
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
