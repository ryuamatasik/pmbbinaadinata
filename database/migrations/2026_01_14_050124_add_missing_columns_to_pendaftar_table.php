<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->string('agama', 20)->nullable();
            $table->integer('tinggi_badan')->nullable();
            $table->integer('berat_badan')->nullable();
            $table->string('kewarganegaraan', 50)->nullable();
            $table->string('status_pernikahan', 20)->nullable();
            $table->string('npwp', 20)->nullable();
            // Modify existing
            $table->string('transportasi', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->dropColumn([
                'agama',
                'tinggi_badan',
                'berat_badan',
                'kewarganegaraan',
                'status_pernikahan',
                'npwp',
            ]);
            $table->string('transportasi', 50)->nullable()->change();
        });
    }
};
