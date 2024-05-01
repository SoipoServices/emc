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
            $table->boolean('is_admin')->nullable()->default(false)->after('email_verified_at');
            $table->text('linkedin_profile_url')->nullable()->after('profile_photo_path');
            $table->text('site_url')->nullable()->after('profile_photo_path');
            $table->text('bio')->nullable()->after('profile_photo_path');
            $table->fullText('bio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
    }
};
