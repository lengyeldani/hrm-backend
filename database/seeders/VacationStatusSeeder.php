<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VacationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vacation_statuses')->insert([
            [
                'name' => 'függőben'
            ],
            [
                'name' => 'elfogadva'
            ],
            [
                'name' => 'elutasítva'
            ],
            [
                'name' => 'visszavonva'
            ],
            [
                'name' => 'kötelező'
            ]

        ]);
    }
}
