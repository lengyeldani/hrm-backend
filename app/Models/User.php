<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{


    public function __construct() {

    }


    use SoftDeletes;

    protected $table = 'users';
    public $timestamps = false;
    // protected $fillable = [
    //     'firstName',
    //     'lastName',
    //     'username',
    //     'dateOfBirth',
    //     'mothersFirstName',
    //     'mothersLastName',
    //     'department',
    //     'zipCode',
    //     'address',
    //     'updatedAt'
    // ];


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


}
