<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public function __construct() {

    }

    // protected $fillable = [
    //     'firstName',
    //     'lastName',
    //     'username',
    //     'dateOfBirth',
    //     'mothersFirstName',
    //     'mothersLastName',
    //     'department',
    //     'zipCode',
    //     'address'
    // ];


    protected $username;
    protected $firstName;
    protected $lastName;
    protected $dateOfBirth;
    protected $mothersFirstName;
    protected $mothersLastName;
    protected $department;
    protected $zipCode;
    protected $address;
    protected $createdAt;
    protected $archive;
    protected $archivedAt;
    protected $updatedAt;



    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setArchive($archive)
    {
        $this->archive = $archive;
    }

    public function setArchivedAt($archivedAt)
    {
        $this->archivedAt = $archivedAt;
    }

    public function getArchivedAt()
    {
        return $this->archivedAt;
    }

    public function getArchive()
    {
        return $this->archive;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

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
