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
        Schema::create('categorie_produit', function (Blueprint $table) {
            $table->id();
            $table->string('lib_cat_produit');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorie_produit');
    }
};
