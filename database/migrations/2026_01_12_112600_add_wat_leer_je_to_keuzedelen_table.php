<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('keuzedelen', function (Blueprint $table) {
            $table->text('wat_leer_je')->nullable()->after('beschrijving');
        });
    }

    public function down(): void
    {
        Schema::table('keuzedelen', function (Blueprint $table) {
            $table->dropColumn('wat_leer_je');
        });
    }
};
