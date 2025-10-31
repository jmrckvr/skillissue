<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'role')) {
                    $table->string('role')->default('applicant')->after('email');
                }
                if (!Schema::hasColumn('users', 'profile_image')) {
                    $table->string('profile_image')->nullable()->after('role');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'profile_image')) {
                    $table->dropColumn('profile_image');
                }
                if (Schema::hasColumn('users', 'role')) {
                    $table->dropColumn('role');
                }
            });
        }
    }
};
