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
            'password' => bcrypt(123456789),
            'email' => 'admin@test.com',
            'user_type_id' => 1
        ]);
    }
}
