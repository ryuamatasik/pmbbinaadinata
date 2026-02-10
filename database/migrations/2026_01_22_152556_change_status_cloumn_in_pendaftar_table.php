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
        // Change status from ENUM to VARCHAR to allow flexible statuses like 'Diterima', 'Ditolak', etc.
        DB::statement("ALTER TABLE pendaftar MODIFY COLUMN status VARCHAR(255) DEFAULT 'draft'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to ENUM if needed (optional, but good practice)
        // Note: Data might be truncated if it contains values not in the enum
        DB::statement("ALTER TABLE pendaftar MODIFY COLUMN status ENUM('draft', 'submitted', 'verified', 'rejected') DEFAULT 'draft'");
    }
};
