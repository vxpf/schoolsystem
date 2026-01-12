<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('keuzedeel_user', function (Blueprint $table) {
            $table->boolean('eerder_gedaan')->default(false)->after('status');
            $table->string('eerder_markering')->nullable()->after('eerder_gedaan')->comment('x = gekoppeld, pv = poging vergeven');
        });
    }

    public function down(): void
    {
        Schema::table('keuzedeel_user', function (Blueprint $table) {
            $table->dropColumn(['eerder_gedaan', 'eerder_markering']);
        });
    }
};
