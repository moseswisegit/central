<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1516707493RolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                
                $table->timestamps();
                
            });

             // Insertion des rôles "admin" et "user"
             DB::table('roles')->insert([
                ['title' => 'Super admin'],
                ['title' => 'Chargé'],
                ['title' => 'Secrétaire'],
                ['title' => 'Maitre de choeur'],
                ['title' => 'Trésorier'],
                ['title' => 'Choriste'],
                ['title' => 'Fidèle'],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
