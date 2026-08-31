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
        Schema::create('affectations', function (Blueprint $table) {
            $table->string('Matricule');
            $table->string('CodeG');
            $table->string('CodeM');
            $table->decimal('MHRealiseP', 5, 2)->default(0);
            $table->decimal('MHRealiseD', 5, 2)->default(0);
            $table->primary(['Matricule', 'CodeG', 'CodeM']);
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
        Schema::dropIfExists('affectations');
    }
};
