<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Model
{

    public function __construct() {

    }

    use HasFactory;
    use SoftDeletes;

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


}
