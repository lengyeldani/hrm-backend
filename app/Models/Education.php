<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{

    public $timestamps = false;
    protected $start;
    protected $end;
    protected $table = 'educations';

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function educationType()
    {
        return $this->belongsTo(EducationType::class);
    }
}
