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
        Schema::dropIfExists("choix");
        Schema::create('choix', function (Blueprint $table) {
            $table->integer("etudiant_matricule", unsigned: true);
            $table->enum("status", array("waiting", "rejected", "accepted"))->default("waiting");
            $table->foreign("etudiant_matricule")->references("matricule")->on("etudiants")->cascadeOnDelete();
            $table->foreignId("speciality_id")->references("id")->on("specialities")->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer("priority", unsigned:true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("choix");
    }
};
