<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeProduitTable extends Migration
{
    public function up()
    {
        Schema::create('commande_produit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commandeId');
            $table->unsignedBigInteger('produitId');
            $table->timestamps();

            $table->foreign('commandeId')->references('id')->on('commandes');
            $table->foreign('produitId')->references('id')->on('produits');
        });
    }

    public function down()
    {
        Schema::dropIfExists('commande_produit');
    }
}
