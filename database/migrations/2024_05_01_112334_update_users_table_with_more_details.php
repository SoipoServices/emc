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
        Schema::table('users', function (Blueprint $table) {
            $table->string('telephone')->nullable()->after('bio');
            $table->string('position')->nullable()->after('bio');
            $table->text('facebook_url')->nullable()->after('bio');
            $table->text('twitter_url')->nullable()->after('bio');
            $table->text('youtube_url')->nullable()->after('bio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['telephone','position','facebook_url','twitter_url','youtube_url']);
        });
    }
};
