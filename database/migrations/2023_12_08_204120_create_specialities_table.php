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
        Schema::dropIfExists('specialities');
        Schema::create('specialities', function (Blueprint $table) {
            $table->id();
            $table->string("university")->nullable();
            $table->string('name');
            $table->boolean("only_bac");
            $table->integer("places", unsigned:true);
            $table->string('module_name')->nullable();
            $table->foreign("module_name")->references("name")->on("modules")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialities');
    }
};
