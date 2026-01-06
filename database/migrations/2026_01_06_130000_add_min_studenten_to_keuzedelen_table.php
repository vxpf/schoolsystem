<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('keuzedelen', function (Blueprint $table) {
            $table->integer('min_studenten')->default(15)->after('max_studenten');
        });
    }

    public function down(): void
    {
        Schema::table('keuzedelen', function (Blueprint $table) {
            $table->dropColumn('min_studenten');
        });
    }
};
