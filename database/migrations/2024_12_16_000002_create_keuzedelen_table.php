<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keuzedelen', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->text('beschrijving')->nullable();
            $table->string('code')->unique();
            $table->integer('studiepunten')->default(0);
            $table->string('niveau')->nullable();
            $table->integer('max_studenten')->default(30);
            $table->boolean('actief')->default(true);
            $table->timestamps();
        });

        Schema::create('keuzedeel_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('keuzedeel_id')->constrained('keuzedelen')->onDelete('cascade');
            $table->enum('status', ['aangemeld', 'goedgekeurd', 'afgewezen', 'voltooid'])->default('aangemeld');
            $table->timestamps();

            $table->unique(['user_id', 'keuzedeel_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keuzedeel_user');
        Schema::dropIfExists('keuzedelen');
    }
};
