<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VacationTest extends TestCase
{

    public function test_createVacation()
    {
        $response = $this->call('POST','/api/vacations/store',
        [
            "userId"=> 1,
            "start"=>"2021-05-23",
            "end"=>"2021-05-23",
            "vacationStatus"=>1
        ]);

        $response->assertStatus(200, $response->status());
    }

    public function test_createVacationForSameInterval()
    {
        $response = $this->call('POST','/api/vacations/store',
        [
            "userId"=> 1,
            "start"=>"2021-05-23",
            "end"=>"2021-05-23",
            "vacationStatus"=>1
        ]);

        $response->assertStatus(409, $response->status());
    }

    public function test_vacationHaveGivenKeys()
    {
        $response = $this->
        call('GET','/api/vacations/show/1');

        $response->assertJsonStructure([
            'id',
            'start',
            'end',
            'user_id',
            'vacation_status_id'
            ]
        );
    }

}
