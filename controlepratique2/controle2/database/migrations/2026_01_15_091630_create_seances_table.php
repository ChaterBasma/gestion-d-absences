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
        Schema::create('seances', function (Blueprint $table) {
            $table->string('NumS')->primary();
            $table->string('Matricule');
            $table->string('CodeG');
            $table->string('CodeM');
            $table->enum('TypeCours', ['P', 'D']);
            $table->string('Jour');
            $table->time('HeureD');
            $table->time('HeureF');
            $table->integer('Duree');
            $table->integer('EffAbsent')->default(0);
            $table->foreign('Matricule')->references('Matricule')->on('formateurs')->onDelete('cascade');
            $table->foreign('CodeG')->references('CodeG')->on('groupes')->onDelete('cascade');
            $table->foreign('CodeM')->references('CodeM')->on('modules')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seances');
    }
};
