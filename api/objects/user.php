<?php

class User
{
    private $userId;
    private $name;
    private $userLogin;
    private $userPassword;
    private $address;
    private $gender;
    private $birthdate;
    private $citizenCard;
    private $userType;

    public function __construct($userId, $name, $userLogin, $userPassword, $address, $gender, $birthdate, $citizenCard, $userType)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->userLogin = $userLogin;
        $this->userPassword = $userPassword;
        $this->address = $address;
        $this->gender = $gender;
        $this->birthdate = $birthdate;
        $this->citizenCard = $citizenCard;
        $this->userType = $userType;
    }

    function get_userId()
    {
        return $this->userId;
    }
    function set_userId($var)
    {
        $this->userId = $var;
    }

    function get_name()
    {
        return $this->name;
    }
    function set_name($var)
    {
        $this->name = $var;
    }

    function get_userLogin()
    {
        return $this->userLogin;
    }
    function set_userLogin($var)
    {
        $this->userLogin = $var;
    }

    function get_userPassword()
    {
        return $this->userPassword;
    }
    function set_userPassword($var)
    {
        $this->userPassword = $var;
    }

    function get_address()
    {
        return $this->address;
    }
    function set_address($var)
    {
        $this->address = $var;
    }

    function get_gender()
    {
        return $this->gender;
    }
    function set_gender($var)
    {
        $this->gender = $var;
    }

    function get_birthdate()
    {
        return $this->birthdate;
    }
    function set_birthdate($var)
    {
        $this->birthdate = $var;
    }

    function get_citizenCard()
    {
        return $this->citizenCard;
    }
    function set_citizenCard($var)
    {
        $this->citizenCard = $var;
    }

    function get_userType()
    {
        return $this->userType;
    }
    function set_userType($var)
    {
        $this->userType = $var;
    }
}
