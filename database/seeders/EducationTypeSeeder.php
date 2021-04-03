<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('education_types')->insert([
            [
                'name' => 'languageClass'
            ],
            [
                'name' => 'workEducation'
            ],
            [
                'name' => 'selfEducation'
            ]
        ]);
    }
}
