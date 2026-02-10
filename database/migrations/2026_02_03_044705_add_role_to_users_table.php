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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('mahasiswa')->after('email');
        });

        // Retroactively populate roles based on email convention
        DB::table('users')->where('email', 'like', '%admin%')->update(['role' => 'admin']);
        DB::table('users')->where('email', 'like', '%pimpinan%')->update(['role' => 'pimpinan']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
