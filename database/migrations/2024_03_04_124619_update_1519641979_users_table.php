<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1519641979UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            
if (!Schema::hasColumn('users', 'stripe_customer_id')) {
                $table->string('stripe_customer_id')->nullable();
                }
if (!Schema::hasColumn('users', 'role_until')) {
                $table->datetime('role_until')->nullable();
                }
        });

        $user = DB::table('users')->insertGetId([
            'name' => 'super admin',
            'email' => 'super@admin.com',
            'password' => bcrypt('password'),
            'role_id' => config('quickadmin.can_see_all_records_role_id'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

         DB::table('uts')->insertGetId([
            'user_id' => $user,
            'nom' => 'super admin',
            'email' => 'super@admin.com', // Assurez-vous de hasher le mot de passe
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('stripe_customer_id');
            $table->dropColumn('role_until');
            
        });

    }
}
