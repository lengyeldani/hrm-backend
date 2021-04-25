<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            [
                'name' => 'HRM1'
            ],
            [
                'name' => 'HRM2'
            ],
            [
                'name' => 'HRM3'
            ],
            [
                'name' => 'HRM4'
            ],
            [
                'name' => 'HRM5'
            ]

        ]);

    }
}
