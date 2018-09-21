<?php

use Illuminate\Database\Seeder;

class FileCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      
        $categories = array(
            [
                'name' => 'Local Resolutions',
                'description' => 'Local Resolutions'
            ],
            [
                'name' => 'Minutes of Meetings',
                'description' => 'Minutes of Meetings'
            ], 
            [
                'name' => 'Journals',
                'description' => 'Journals',
            ], 
            [
                'name' => 'Agenda',
                'description' => 'Agenda',
            ], 
            [
                'name' => 'Committee Reports',
                'description' => 'Committee Reports',
            ], 
            [
                'name' => 'Proposed Legislation',
                'description' => 'Proposed Legislation',
            ], 
            [
                'name' => 'Local Ordinance',
                'description' => 'Local Ordinance',
            ]
        );

        foreach ($categories as $category) {
            $data = \App\FileCategory::firstOrNew($category);
            $data->fill($category);
            $data->save();
        }
    }
}
