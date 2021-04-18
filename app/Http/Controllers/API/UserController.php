<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserWithAllResource;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use App\Models\VacationCounter;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = new UserCollection(User::where('deleted_at', null)->paginate(10));
        return response($users,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = new User();
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->username = strtoupper($request->username);
        $user->dateOfBirth = DateTime::createFromFormat('Y-m-d',$request->dateOfBirth);
        $user->mothersFirstName = $request->mothersFirstName;
        $user->mothersLastName = $request->mothersLastName;
        $department = Department::findOrFail($request->department);
        $user->department()->associate($department);
        $role = Role::findOrFail($request->role);
        $user->role()->associate($role);
        $vacationCounter = new VacationCounter();
        $vacationCounter->max = $request->vacationCounter_max;
        $vacationCounter->used = 0;
        $vacationCounter->remaining = $request->vacationCounter_max;
        $user->zipCode = $request->zipCode;
        $user->address = $request->address;
        $user->createdAt = new DateTime();
        $user->updatedAt = null;
        $user->save();
        $user->refresh();
        $user->findOrFail($user->id)->vacationCounter()->save($vacationCounter);

        //dd($user->with('vacation_counter')->where('user_id', $user->id));
        return response($user,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response($user, 200);
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
        $user = User::findOrFail($id);
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->username = strtoupper($request->username);
        $user->dateOfBirth = DateTime::createFromFormat('Y-m-d',$request->dateOfBirth);
        $user->mothersFirstName = $request->mothersFirstName;
        $user->mothersLastName = $request->mothersLastName;
        $department = Department::findOrFail($request->department);
        $user->department()->associate($department);
        $role = Role::findOrFail($request->role);
        $user->role()->associate($role);
        $user->zipCode = $request->zipCode;
        $user->address = $request->address;
        $user->vacationCounter()->update([
            'max'=>$request->vacationCounter_max,
            'remaining'=>$user->vacationCounter->remaining + ($request->vacationCounter_max - $user->vacationCounter->max)
            ]);
        $user->updatedAt = new DateTime();
        $user->save();
        $user->refresh();

        return response($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            User::destroy($id);
        } catch (\Throwable $th) {
            return response($th,405);
        }

        return response('',200);
    }

    public function employeesByDepartment()
    {
        $employeesByDepartment = new UserCollection(User::where('department_id',Auth::user()->department_id)->paginate(10));

        return response($employeesByDepartment,200);
    }

    public function getLoggedInUser()
    {
        return response(Auth::user(),200);
    }

    public function getUserRoles()
    {
        return response(Role::all(),200);
    }

    public function getDepartments()
    {
        return response(Department::all(), 200);
    }
}
