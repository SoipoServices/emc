<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->string('url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('photo_path', 2048)->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            $table->integer('priority')->default(0);
            $table->boolean('is_sponsor')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('businesses');
    }
};
