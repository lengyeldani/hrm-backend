<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacationCounter extends Model
{

    public $timestamps = false;
    protected $table='vacation_counters';
    protected $id;
    protected $max;
    protected $used;

    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
