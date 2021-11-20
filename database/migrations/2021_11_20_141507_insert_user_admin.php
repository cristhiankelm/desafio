<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class InsertUserAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $email = env('ADMIN_EMAIL', 'criskp007@gmail.com');
        $password = bcrypt(env('ADMIN_PASSWORD', 'admin'));
        DB::table('users')->insert([
            'name' => 'Cristhian',
            'email' => $email,
            'password' => $password
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $email = env('ADMIN_EMAIL', 'criskp007@gmail.com');
//        $password = env('ADMIN_PASSWORD', 'admin');
        DB::delete('DELETE FROM users WHERE email = ?', [$email]);
    }
}
