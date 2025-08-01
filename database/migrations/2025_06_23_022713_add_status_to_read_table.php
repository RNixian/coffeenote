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
        Schema::table('read', function (Blueprint $table) {
            $table->enum('status', ['ongoing', 'completed', 'archived'])->default('ongoing')->before('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('read', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
