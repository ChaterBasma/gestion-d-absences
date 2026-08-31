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
        Schema::table('modules', function (Blueprint $table) {
            // Modifier les colonnes de date à integer (heures)
            $table->integer('MHP')->default(0)->change();
            $table->integer('MHD')->default(0)->change();
            $table->integer('MHG')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->date('MHP')->change();
            $table->date('MHD')->change();
            $table->date('MHG')->change();
        });
    }
};
