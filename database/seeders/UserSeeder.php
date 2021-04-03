<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'firstName'=>'Dániel',
                'lastName'=>'Lengyel',
                'username'=>'LDANI1',
                'dateOfBirth'=>'1994-01-06',
                'mothersFirstName'=>'Anyja Keresztneve',
                'mothersLastName'=>'Anyja Vezetékneve',
                'department_id'=>1,
                'role_id'=>1,
                'zipCode'=>'3200',
                'address'=>'Gyöngyös Ifjúság utca 6.',
                'createdAt'=> new DateTime()
            ]
        ]);
    }
}
