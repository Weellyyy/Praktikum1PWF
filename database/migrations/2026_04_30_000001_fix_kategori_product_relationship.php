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
        // Hapus product_id column dari kategoris jika ada
        Schema::table('kategoris', function (Blueprint $table) {
            if (Schema::hasColumn('kategoris', 'product_id')) {
                $table->dropForeign(['product_id']);
                $table->dropColumn('product_id');
            }
        });

        // Tambah kategori_id ke products jika belum ada
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'kategori_id')) {
                $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus kategori_id dari products
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'kategori_id')) {
                $table->dropForeign(['kategori_id']);
                $table->dropColumn('kategori_id');
            }
        });

        // Tambah kembali product_id ke kategoris
        Schema::table('kategoris', function (Blueprint $table) {
            if (!Schema::hasColumn('kategoris', 'product_id')) {
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
            }
        });
    }
};
