<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'vacations';
    protected $id;
    protected $start;
    protected $end;


    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function vacationStatus()
    {
        return $this->belongsTo(VacationStatus::class);
    }
}
