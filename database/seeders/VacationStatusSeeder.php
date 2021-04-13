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
                'name' => 'pending'
            ],
            [
                'name' => 'accepted'
            ],
            [
                'name' => 'declined'
            ],
            [
                'name' => 'cancelled'
            ],
            [
                'name' => 'forced'
            ]

        ]);
    }
}
