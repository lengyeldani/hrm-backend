<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\EducationType;
use App\Models\User;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Education::paginate(10);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $education = new Education();
        $education->start = date('Y-m-d H:i:s',strtotime($request->start));
        $education->end = date('Y-m-d H:i:s',strtotime($request->end));
        $educationType = EducationType::findOrFail($request->educationType);
        $education->educationType()->associate($educationType);
        $user = User::findOrFail($request->userId);
        $user->educations()->save($education);

        return response($education,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(Education::findOrFail($id),200);
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
        $education = Education::findOrFail($id);

        $education->start = $request->start;
        $education->end = $request->end;
        $user = User::findOrFail($education->user_id);
        $user->educations()->save($education);

        return response($education,200);
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
