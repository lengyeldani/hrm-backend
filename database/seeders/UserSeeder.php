<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VacationCounter;
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

        $user = new User();
        $user->firstName = "Dániel";
        $user->lastName = "Lengyel";
        $user->username = "LDANI1";
        $user->dateOfBirth = "1994-01-06";
        $user->mothersFirstName = "Anyja Keresztneve";
        $user->mothersLastName = "Anyja vezetékneve";
        $department = 1;
        $user->department()->associate($department);
        $role = 5;
        $user->role()->associate($role);
        $vacationCounter = new VacationCounter();
        $vacationCounter->max = 24;
        $vacationCounter->used = 0;
        $vacationCounter->remaining = 24;
        $user->zipCode = "3200";
        $user->address = "Gyöngyös Ifjúság u. 6.";
        $user->createdAt = new DateTime();
        $user->updatedAt = null;
        $user->save();
        $user->refresh();
        $user->findOrFail($user->id)->vacationCounter()->save($vacationCounter);
    }
}
