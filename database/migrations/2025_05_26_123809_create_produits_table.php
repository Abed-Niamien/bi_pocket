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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('lib_produit');
            $table->decimal('prix_unitaire', 10, 2);
            $table->string('couleur_motif')->nullable();
            $table->string('photo_produit')->nullable();
            $table->unsignedBigInteger('id_cat_produit');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            // Clé étrangère vers categorie_produits
            $table->foreign('id_cat_produit')->references('id')->on('categorie_produit')->onDelete('cascade');
            
            // Clé étrangère vers user
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
       
        });
    }

    public function down()
    {
        Schema::dropIfExists('produits');
    }
};
