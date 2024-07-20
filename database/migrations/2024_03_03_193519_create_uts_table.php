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
        Schema::create('uts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->unique(); // Utilisez unsignedBigInteger si vous utilisez une clé primaire de type unsignedBigInteger dans la table users, sinon utilisez simplement unsignedInteger
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Ajoutez onDelete('cascade') si vous souhaitez supprimer automatiquement les enregistrements liés lorsqu'un utilisateur est supprimé
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('identifiant')->nullable();
            $table->string('password')->nullable();
            $table->string('profile_picture')->nullable();
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
        Schema::dropIfExists('uts');
    }
};
