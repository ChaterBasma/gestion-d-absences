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
        Schema::create('modules', function (Blueprint $table) {
            $table->string('CodeM')->primary();
            $table->string('CodeF');
            $table->date('MHG');
            $table->date('MHP');
            $table->date('MHD');
            $table->enum('coef', ['1', '2', '3']);
            $table->foreign('CodeF')->references('CodeF')->on('filieres')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
