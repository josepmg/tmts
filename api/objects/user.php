<?php

class User
{
    private int $userId;
    private string $userName;
    private string $userLogin;
    private string $userPassword;
    private string $address;
    private UserGender $gender;
    private DateTime $birthdate;
    private string $citizenCard;
    private UserType $userType;
    private bool $isActive;

    public function __construct($userId, $name, $userLogin, $userPassword, $address, $gender, $birthdate, $citizenCard, $userType, $isActive)
    {
        $this->userId = $userId;
        $this->userName = $name;
        $this->userLogin = $userLogin;
        $this->userPassword = $userPassword;
        $this->address = $address;
        $this->gender = $gender;
        $this->birthdate = $birthdate;
        $this->citizenCard = $citizenCard;
        $this->userType = $userType;
        $this->isActive = $isActive;
    }

    function get_userId()
    {
        return $this->userId;
    }
    function set_userId($var)
    {
        $this->userId = $var;
    }

    function get_userName() : string
    {
        return $this->userName;
    }
    function set_userName($var)
    {
        $this->userName = $var;
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

    public function isActive(): bool
    {
        return $this->isActive;
    }
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }


}
