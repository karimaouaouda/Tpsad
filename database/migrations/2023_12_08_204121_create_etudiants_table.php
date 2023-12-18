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
        Schema::dropIfExists('etudiants');
        Schema::create('etudiants', function (Blueprint $table) {
            $table->integer("matricule", unsigned : true)->primary();
            $table->string('name');
            $table->string('branch_name');
            $table->foreignId("speciality_id")->nullable()->references("id")->on("specialities")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('branch_name')->references('name')->on('branches')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean("oriented")->default(false);
            $table->string('profile_photo_path', 2048)->nullable();
            $table->float("bac_note", unsigned: true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
