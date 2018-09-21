<?php

use Illuminate\Database\Seeder;

class MakeDefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'password' => bcrypt('123456789'),
            'email' => str_random(10) . '@gmail.com',
            'user_type_id' => 1
        ]);
    }
}
