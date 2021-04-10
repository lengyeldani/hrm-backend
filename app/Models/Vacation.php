<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'vacations';
    protected $id;
    protected $date;

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function vacationStatus()
    {
        return $this->belongsTo(VacationStatus::class);
    }
}
