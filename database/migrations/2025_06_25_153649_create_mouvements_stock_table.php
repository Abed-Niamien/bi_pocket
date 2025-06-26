<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMouvementsStockTable extends Migration
{
    public function up()
    {
        Schema::create('mouvements_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produit')->constrained('produits')->onDelete('cascade');
            $table->integer('quantite');
            $table->enum('type_mouvement', ['entree', 'sortie']);
            $table->date('date_mouvement');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mouvements_stock');
    }
}
