<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';
    public $timestamps = false;
    protected $appends = ['vacationCounter_max','vacationCounter_used'];

    private $username;
    private $firstName;
    private $lastName;
    private $dateOfBirth;
    private $mothersFirstName;
    private $mothersLastName;
    private $department;
    private $zipCode;
    private $address;
    private $createdAt;
    private $updatedAt;

    public function getVacationCounterMaxAttribute()
    {
        return $this->vacationCounter->max;
    }

    public function getVacationCounterUsedAttribute()
    {
        return $this->vacationCounter->used;
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function vacations()
    {
        return $this->hasMany(Vacation::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function vacationCounter()
    {
        return $this->hasOne(VacationCounter::class);
    }

    public function getAuthIdentifier()
    {
        return $this->username;
    }

    public function getAuthIdentifierName()
    {
        return $this->username;
    }

    public function getAuthPassword()
    {
        return "";
    }

    public function getRememberToken()
    {
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
        return "";
    }


}
