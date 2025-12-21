<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Voeg periode toe aan keuzedelen
        Schema::table('keuzedelen', function (Blueprint $table) {
            $table->string('periode')->nullable()->after('actief');
        });

        // Voeg huidige_periode toe aan users
        Schema::table('users', function (Blueprint $table) {
            $table->string('huidige_periode')->default('2024-2025-P1')->after('role');
        });

        // Verwijder prioriteit kolom (niet meer nodig met 1 keuzedeel per periode)
        Schema::table('keuzedeel_user', function (Blueprint $table) {
            $table->dropColumn('prioriteit');
        });
    }

    public function down(): void
    {
        Schema::table('keuzedelen', function (Blueprint $table) {
            $table->dropColumn('periode');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('huidige_periode');
        });

        Schema::table('keuzedeel_user', function (Blueprint $table) {
            $table->integer('prioriteit')->default(1);
        });
    }
};
