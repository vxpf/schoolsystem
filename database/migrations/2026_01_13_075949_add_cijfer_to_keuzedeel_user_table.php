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
            $table->decimal('cijfer', 3, 1)->nullable()->after('status')->comment('Cijfer van 1.0 tot 10.0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keuzedeel_user', function (Blueprint $table) {
            $table->dropColumn('cijfer');
        });
    }
};
