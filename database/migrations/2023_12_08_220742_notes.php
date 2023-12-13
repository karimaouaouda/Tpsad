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
        Schema::create('notes', function (Blueprint $table) {
            $table->integer("etudiant_matricule", unsigned:true);
            $table->foreign("etudiant_matricule")->references("matricule")->on("etudiants")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("module_name");
            $table->foreign("module_name")->references("name")->on("modules")->cascadeOnDelete()->cascadeOnUpdate();
            $table->float("note", unsigned:true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("notes");
    }
};
