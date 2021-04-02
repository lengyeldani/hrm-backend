<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
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
        $users = DB::table('users')->paginate(10);
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
        $user->username = $request->username;
        $user->dateOfBirth = DateTime::createFromFormat('Y-m-d',$request->dateOfBirth);
        $user->mothersFirstName = $request->mothersFirstName;
        $user->mothersLastName = $request->mothersLastName;
        $user->department = $request->department;
        $user->zipCode = $request->zipCode;
        $user->address = $request->address;
        $user->createdAt = new DateTime();
        $user->updatedAt = null;
        $user->save();

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
        $user = DB::table('users')->find($id);
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
        $user = User::find($id);
        //dd($user->updatedAt);
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->username = $request->username;
        $user->dateOfBirth = DateTime::createFromFormat('Y-m-d',$request->dateOfBirth);
        $user->mothersFirstName = $request->mothersFirstName;
        $user->mothersLastName = $request->mothersLastName;
        $user->department = $request->department;
        $user->zipCode = $request->zipCode;
        $user->address = $request->address;
        $user->updatedAt = new DateTime();
        //dd($user);
        $user->save();

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

        User::destroy($id);


        return response(User::find($id),200);
    }
}
