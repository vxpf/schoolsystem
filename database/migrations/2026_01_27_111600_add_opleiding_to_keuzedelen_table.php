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
        Schema::table('keuzedelen', function (Blueprint $table) {
            $table->string('opleiding')->nullable()->after('niveau')->comment('Opleiding waarvoor dit keuzedeel beschikbaar is');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keuzedelen', function (Blueprint $table) {
            $table->dropColumn('opleiding');
        });
    }
};
