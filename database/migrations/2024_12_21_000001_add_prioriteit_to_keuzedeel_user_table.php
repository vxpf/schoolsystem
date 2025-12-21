<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('keuzedeel_user', function (Blueprint $table) {
            $table->integer('prioriteit')->default(1)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('keuzedeel_user', function (Blueprint $table) {
            $table->dropColumn('prioriteit');
        });
    }
};
