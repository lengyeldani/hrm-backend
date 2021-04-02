<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vacation;
use App\Models\VacationStatus;
use Database\Seeders\VacationStatusSeeder;
use Illuminate\Http\Request;

class VacationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vacation::paginate(10);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vacation = new Vacation();
        $vacation->date = $request->date;
        $vacationStatus = VacationStatus::findOrFail(1);
        $vacation->vacationStatus()->associate($vacationStatus);
        $user = User::findOrFail($request->userId);
        $user->vacations()->save($vacation);

        return response($vacation,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(Vacation::findOrFail($id),200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vacation = Vacation::findOrFail($id);
        $vacationStatus = VacationStatus::findOrFail($request->vacationStatus);
        $vacation->vacationStatus()->associate($vacationStatus);
        $user = User::findOrFail($vacation->user_id);
        $user->vacations()->save($vacation);

        return response($vacation,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
