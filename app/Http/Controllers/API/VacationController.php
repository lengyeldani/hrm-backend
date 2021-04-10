<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserWithAllResource;
use App\Http\Resources\VacationResource;
use App\Models\User;
use App\Models\Vacation;
use App\Models\VacationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VacationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(UserWithAllResource::collection(User::paginate(10)));
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

    public function showByUser($id)
    {
        $vacation = VacationResource::collection(Vacation::where('user_id',$id)->paginate(10));

        return response($vacation,200);
    }

    public function changeVacationStatus(Request $request)
    {
        $vacation = Vacation::findOrFail($request->vacation_id);
        $status= VacationStatus::findOrFail($request->status_id);
        $vacation->vacationStatus()->associate($status);
        $user = User::findOrFail($vacation->user_id);
        $user->vacations()->save($vacation);

        return response($vacation, 200);
    }

    public function vacationStatuses()
    {
        $vacationStatuses = VacationStatus::all();

        return response($vacationStatuses, 200);
    }
}
