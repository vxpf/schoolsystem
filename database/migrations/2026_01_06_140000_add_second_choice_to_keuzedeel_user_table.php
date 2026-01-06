<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('keuzedeel_user', function (Blueprint $table) {
            $table->foreignId('second_choice_keuzedeel_id')->nullable()->constrained('keuzedelen')->onDelete('set null')->after('keuzedeel_id');
        });
    }

    public function down(): void
    {
        Schema::table('keuzedeel_user', function (Blueprint $table) {
            $table->dropForeignIdFor('second_choice_keuzedeel_id');
            $table->dropColumn('second_choice_keuzedeel_id');
        });
    }
};
