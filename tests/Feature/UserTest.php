<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_createUser()
    {
        $response = $this->call('POST', '/api/users/store',[
            "firstName"=>"Test",
            "lastName"=>"User",
            "username"=>"valami",
            "dateOfBirth"=>"1994-01-06",
            "mothersFirstName"=>"Anyja Keresztneve",
            "mothersLastName"=>"Anyja Vezetékneve",
            "department"=>1,
            "role"=>1,
            "zipCode"=>"3200",
            "address"=>"Gyöngyös Ifjúság utca 6.",
            "vacationCounter_max"=>30,
            "vacationCounter_used"=>0
        ]);

        $response->assertStatus(200);
    }

    public function test_createUserAgainWithSameUsername()
    {
        $response = $this->call('POST', '/api/users/store',[
            "firstName"=>"Test",
            "lastName"=>"User",
            "username"=>"valami",
            "dateOfBirth"=>"1994-01-06",
            "mothersFirstName"=>"Anyja Keresztneve",
            "mothersLastName"=>"Anyja Vezetékneve",
            "department"=>1,
            "role"=>1,
            "zipCode"=>"3200",
            "address"=>"Gyöngyös Ifjúság utca 6.",
            "vacationCounter_max"=>30,
            "vacationCounter_used"=>0
        ]);

        $response->assertStatus(400);
    }

    public function test_findUserById()
    {
        $response = $this->call('GET','/api/users/show/1');

        $response->assertStatus(200);
    }
}
