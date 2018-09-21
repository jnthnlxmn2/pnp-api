<?php

use Illuminate\Database\Seeder;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array(
            [
                'role' => 'Admin',
                'description' => 'Admin'
            ],
            [
                'role' => 'User',
                'description' => 'User'
            ]
          
        );

        foreach ($types as $type) {
            $data = \App\UserType::firstOrNew($type);
            $data->fill($type);
            $data->save();
        }
    }
}
