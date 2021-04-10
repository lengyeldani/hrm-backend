<?php

namespace App\Http\Resources;

use App\Models\EducationType;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
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
            'start'=>$this->start,
            'end'=>$this->end,
            'education_type'=>EducationType::findOrFail($this->education_type_id)
        ];
    }
}
