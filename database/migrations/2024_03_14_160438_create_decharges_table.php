<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decharges', function (Blueprint $table) {
            $table->id();
            $table->string('nom_donneur')->nullable()->default(null); // Modifié pour respecter la convention de nommage
            $table->string('nom_receveur')->nullable()->default(null); // Modifié pour respecter la convention de nommage
            $table->string('motif')->nullable()->default(null); // Modifié pour respecter la convention de nommage
            $table->string('url')->nullable()->default(null); // Modifié pour respecter la convention de nommage
            $table->date('date_emission')->nullable()->default(null); // Modifié pour respecter la convention de nommage
            $table->unsignedBigInteger('montant')->nullable()->default(null);
            $table->unsignedInteger('user_id')->nullable()->default(null); // Ajoutez cette ligne pour la clé étrangère
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Modifié pour respecter la convention de nommage
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('decharges');
    }
};
