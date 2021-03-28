<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends BaseModel
{

    public function __construct(
        $firstName,
        $lastName,
        $username,
        $dateOfBirth,
        $mothersFirstName,
        $mothersLastName,
        $department,
        $zipCode,
        $address,
        $archive,
        $archivedAt,
        $updatedAt
    ) {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setUsername($username);
        $this->setDateOfBirth($dateOfBirth);
        $this->setMothersFirstName($mothersFirstName);
        $this->setMothersLastName($mothersLastName);
        $this->setDepartment($department);
        $this->setZipCode($zipCode);
        $this->setAddress($address);

        parent::__construct($archive,$archivedAt,$updatedAt);
    }

    protected $username;
    protected $firstName;
    protected $lastName;
    protected $dateOfBirth;
    protected $mothersFirstName;
    protected $mothersLastName;
    protected $department;
    protected $zipCode;
    protected $address;

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function setMothersFirstName($mothersFirstName)
    {
        $this->mothersFirstName = $mothersFirstName;
    }

    public function getMothersFirstName()
    {
        return $this->mothersFirstName;
    }

    public function setMothersLastName($mothersLastName)
    {
        $this->mothersLastName = $mothersLastName;
    }

    public function getMothersLastName()
    {
        return $this->mothersLastName;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function setDepartment($department)
    {
        $this->department = $department;
    }
}
