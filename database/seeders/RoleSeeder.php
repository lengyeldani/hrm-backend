<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'e1'
            ],
            [
                'name' => 'e2'
            ],
            [
                'name' => 'e3'
            ],
            [
                'name'=> 'boss'
            ],
            [
                'name'=> 'admin'
            ]

        ]);
    }
}
