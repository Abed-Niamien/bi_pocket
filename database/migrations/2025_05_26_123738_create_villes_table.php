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
        Schema::create('villes', function (Blueprint $table) {
            $table->id();
            $table->string('lib_ville');
            $table->unsignedBigInteger('id_pays');
            $table->timestamps();

            // Clé étrangère vers la table pays
            $table->foreign('id_pays')->references('id')->on('pays')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('villes');
    }
};
