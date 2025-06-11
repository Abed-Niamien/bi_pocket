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
        Schema::create('produit_vente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_vente')->constrained('ventes')->onDelete('cascade');
            $table->foreignId('id_produit')->constrained('produits')->onDelete('cascade');
            $table->decimal('quantite_vente', 10, 2);
            $table->decimal('montant_total', 10, 2);
            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('produit_vente');
    }
};