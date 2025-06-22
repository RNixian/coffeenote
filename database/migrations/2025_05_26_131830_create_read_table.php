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
        Schema::create('read', function (Blueprint $table) {
          $table->id();
            $table->string('title');
            $table->integer('volume')->nullable();
            $table->integer('chapter')->nullable();
            $table->integer('page')->nullable();
            $table->string('coverphoto')->nullable();
            $table->string('category')->nullable();
            $table->string('genre')->nullable();
            $table->string('author')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('read');
    }
};
