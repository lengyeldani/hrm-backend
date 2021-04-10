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
        return [
            'id' => $this->id,
            'date'=>$this->date,
            'vacation_status'=>VacationStatus::findOrFail($this->vacation_status_id)
        ];
    }
}
