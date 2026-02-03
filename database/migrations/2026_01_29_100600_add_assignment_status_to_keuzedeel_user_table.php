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
        Schema::table('keuzedeel_user', function (Blueprint $table) {
            if (!Schema::hasColumn('keuzedeel_user', 'assignment_status')) {
                $table->enum('assignment_status', ['first_choice', 'second_choice', 'pending'])->default('pending')->after('status')->comment('Whether student was assigned to first or second choice');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keuzedeel_user', function (Blueprint $table) {
            if (Schema::hasColumn('keuzedeel_user', 'assignment_status')) {
                $table->dropColumn('assignment_status');
            }
        });
    }
};
