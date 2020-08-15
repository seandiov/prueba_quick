<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
         DB::table('tb_user')->insert([
            'id' => 1,
            'first_name' => 'Sergio Andres',
            'last_name' => 'Diaz Oviedo',
            'age' => '28',
            'email' => 'sergio.diaz@gmail.com',
            'password' => bcrypt(123456),
            'token' => NULL,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

}
