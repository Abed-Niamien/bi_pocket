<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('communes', function (Blueprint $table) {
            $table->id();
            $table->string('lib_commune');
            $table->unsignedBigInteger('id_ville');
            $table->timestamps();

            // Clé étrangère vers la table villes
            $table->foreign('id_ville')->references('id')->on('villes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('communes');
    }
};
