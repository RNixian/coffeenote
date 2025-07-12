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
            $table->text('title')->change();
            $table->string('chapter')->change();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('read', function (Blueprint $table) {
            $table->string('title')->change();
            $table->integer('chapter')->change();
        });
    }
};
