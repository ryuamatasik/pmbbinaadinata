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
        Schema::create('syarat_dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->boolean('wajib')->default(true);
            $table->string('format')->default('PDF, JPG, PNG');
            $table->string('max_size')->default('2MB');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syarat_dokumens');
    }
};
