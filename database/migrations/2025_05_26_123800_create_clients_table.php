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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('telephone_client')->nullable();
            $table->enum('sexe_client', ['M', 'F'])->nullable();
            $table->string('nom_client');
            $table->string('email_client')->unique()->nullable();
            $table->unsignedBigInteger('id_commune');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            // Clé étrangère vers la table communes
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_commune')->references('id')->on('communes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
