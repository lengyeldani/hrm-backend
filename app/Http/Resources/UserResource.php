<?php

namespace App\Http\Resources;

use App\Models\Department;
use App\Models\Role;
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
        return [
            'id'=>$this->id,
            'firstName'=>$this->firstName,
            'lastName'=>$this->lastName,
            'username'=>$this->username,
            'dateOfBirth'=>$this->dateOfBirth,
            'mothersFirstName'=>$this->mothersFirstName,
            'mothersLastName'=>$this->mothersLastName,
            'department'=>Department::findOrFail($this->department_id),
            'address'=>$this->address,
            'zipCode'=>$this->zipCode,
            'role'=>Role::findOrFail($this->role_id),
            'vacationCounter'=>VacationCounter::where('user_id', $this->id)->first(),
            'vacations'=>VacationResource::collection(Vacation::where('user_id',$this->id)->get()),
            'createdAt'=>$this->createdAt,
            'updatedAt'=>$this->updatedAt
        ];
    }
}
