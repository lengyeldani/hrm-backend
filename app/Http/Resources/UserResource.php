<?php

namespace App\Http\Resources;

use App\Models\Department;
use App\Models\Education;
use App\Models\Role;
use App\Models\User;
use App\Models\Vacation;
use App\Models\VacationCounter;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $max = User::findOrFail($this->id)->vacationCounter->max;
        $used = User::findOrFail($this->id)->vacationCounter->used;
        $remaining = $max-$used;

        return [
            'id'=>$this->id,
            'firstName'=>$this->firstName,
            'lastName'=>$this->lastName,
            'dateOfBirth'=>$this->dateOfBirth,
            'mothersFirstName'=>$this->mothersFirstName,
            'mothersLastName'=>$this->mothersLastName,
            'department'=>Department::findOrFail($this->department_id),
            'address'=>$this->address,
            'zipCode'=>$this->zipCode,
            'role'=>Role::findOrFail($this->role_id),
            'vacationCounter'=>VacationCounter::where('user_id', $this->id)->get(),
            'vacations'=>VacationResource::collection(Vacation::where('user_id',$this->id)->get()),
            'educations'=> EducationResource::collection(Education::where('user_id',$this->id)->get()),
            'createdAt'=>$this->createdAt,
            'updatedAt'=>$this->updatedAt,
            'used'=>$used,
            'remaining'=> $remaining,
        ];
    }
}
