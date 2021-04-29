<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\VacationCollection;
use App\Models\User;
use App\Models\Vacation;
use App\Models\VacationStatus;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(new UserCollection((User::paginate(10))),200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $start = new DateTime($request->start);
        $end = new DateTime($request->end);
        $interval = $start->diff($end);
        $interval = (integer)$interval->format('%a') + 1;
        $user = User::findOrFail($request->userId);

        $reservedStart = Vacation::where('user_id',$user->id)->
        whereDate('start','<=', date($request->start))->
        whereDate('end','>=',date($request->start))->
        first();

        $reservedEnd = Vacation::where('user_id',$user->id)->
        whereDate('start','<=', date($request->end))->
        whereDate('end','>=',date($request->end))->
        first();

        if($reservedStart !== null || $reservedEnd !== null){
            return response('',409);
        }

        if($user->vacationCounter->remaining - $interval >= 0){
            $vacation = new Vacation();
            $vacation->start = $start;
            $vacation->end = $end;
            $vacationStatus = VacationStatus::findOrFail($request->vacationStatus);
            $vacation->vacationStatus()->associate($vacationStatus);
            $user->vacationCounter->used = $user->vacationCounter->used + $interval;
            $user->vacationCounter->remaining = $user->vacationCounter->remaining - $interval;
            $user->push();
            $user->vacations()->save($vacation);

            return response($vacation,200);
        }
        else{
            return response('',400);
        }
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

        if(Auth::user()->role_id>3){
            $vacation = Vacation::findOrFail($id);
            $user = User::findOrFail($vacation->user_id);
            $vacationStatus = VacationStatus::findOrFail((integer)$request->vacationStatus);
            $start = new DateTime($vacation->start);
            $end = new DateTime($vacation->end);
            $interval = $start->diff($end);
            $interval = (integer)$interval->format('%a') + 1;

            if($user->vacationCounter->remaining - $interval >= 0){
                if((integer)$request->vacationStatus === 1 || (integer)$request->vacationStatus === 2 || (integer)$request->vacationStatus === 5){
                    if($vacation->vacation_status_id === 3){
                        $user->vacationCounter->used += $interval;
                        $user->vacationCounter->remaining -= $interval;
                        $user->push();
                        $vacation->vacationStatus()->associate($vacationStatus);
                        $user->vacations()->save($vacation);
                        $vacation->refresh();
                        return response($vacation,200);
                    }
                    else{
                        $vacation->vacationStatus()->associate($vacationStatus);
                        $user->vacations()->save($vacation);
                        $vacation->refresh();
                        return response($vacation,200);
                    }
                }
                else if((integer)$request->vacationStatus === 3){
                    $user->vacationCounter->used -= $interval;
                    $user->vacationCounter->remaining += $interval;
                    $user->push();
                    $vacation->vacationStatus()->associate($vacationStatus);
                    $user->vacations()->save($vacation);
                    $vacation->refresh();
                    return response($vacation,200);
                }
            }
        }
        else{
            return response('',401);
        }
    }


    public function cancelVacation($id)
    {

        $vacation = Vacation::findOrFail($id);

        if($vacation->vacation_status_id === 1){

            $user = User::findOrFail($vacation->user_id);

            $start = new DateTime($vacation->start);
            $end = new DateTime($vacation->end);
            $interval = $start->diff($end);
            $interval = (integer)$interval->format('%a') + 1;

            $user->vacationCounter->used -= $interval;
            $user->vacationCounter->remaining += $interval;
            $user->push();

            $vacation->delete();
            return response('', 200);
        }
        else{
            return response('',400);
        }
    }

    public function showByUser($id)
    {
        $vacation = new VacationCollection(Vacation::where('user_id',$id)->orderBy('end','DESC')->paginate(10));

        return response($vacation,200);
    }

    public function vacationStatusesForManager()
    {
        $vacationStatuses = VacationStatus::where('id','!=',4)->get();
        return response($vacationStatuses, 200);
    }


    public function vacationStatuses()
    {
        $vacationStatuses = VacationStatus::all();

        return response($vacationStatuses, 200);
    }
}
