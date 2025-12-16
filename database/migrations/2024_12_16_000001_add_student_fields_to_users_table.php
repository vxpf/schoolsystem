<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('student_number')->unique()->nullable()->after('email');
            $table->string('class')->nullable()->after('student_number');
            $table->string('opleiding')->nullable()->after('class');
            $table->enum('role', ['student', 'docent', 'admin'])->default('student')->after('opleiding');
            $table->string('microsoft_id')->nullable()->after('role');
            $table->string('avatar')->nullable()->after('microsoft_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['student_number', 'class', 'opleiding', 'role', 'microsoft_id', 'avatar']);
        });
    }
};
