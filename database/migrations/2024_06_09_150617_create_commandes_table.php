<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->float('montantTotal');
            $table->unsignedBigInteger('utilisateurId');
            $table->timestamps();

            $table->foreign('utilisateurId')->references('id')->on('utilisateurs');
        });
    }

    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
