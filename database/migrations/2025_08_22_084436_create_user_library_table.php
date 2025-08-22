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
        Schema::create('user_library', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('library_id');
            $table->timestamps();

            // Create foreign key for library_id based on the Zeus Sky Library model
            $table->foreign('library_id')->references('id')->on('libraries')->onDelete('cascade');
            
            // Ensure a user can't save the same library item twice
            $table->unique(['user_id', 'library_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_library');
    }
};
