<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\VacationStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class VacationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $max = User::findOrFail($this->user_id)->vacationCounter->max;
        $used = User::findOrFail($this->user_id)->vacationCounter->used;
        $remaining = User::findOrFail($this->user_id)->vacationCounter->remaining;
        return [
            'id' => $this->id,
            'start'=>$this->start,
            'end'=>$this->end,
            'max'=> $max,
            'used'=>$used,
            'remaining'=>$remaining,
            'vacation_status'=>VacationStatus::findOrFail($this->vacation_status_id)
        ];
    }
}
