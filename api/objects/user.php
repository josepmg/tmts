<?php
include 'api/config/includes.php';

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

    public function __construct($name, $userLogin, $userPassword, $address, $gender, $birthdate, $citizenCard, $userType, $isActive)
    {
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
    public static function createWithId($userId, $name, $userLogin, $userPassword, $address, $gender, $birthdate, $citizenCard, $userType, $isActive) : User
    {
        $instance = new User($name, $userLogin, $userPassword, $address, $gender, $birthdate, $citizenCard, $userType, $isActive);
        $instance->setUserId($userId);

        return $instance;
    }

    function getUserId()
    {
        return $this->userId;
    }
    function setUserId($var)
    {
        $this->userId = $var;
    }

    function getUserName() : string
    {
        return $this->userName;
    }
    function setUserName($var)
    {
        $this->userName = $var;
    }

    function getUserLogin()
    {
        return $this->userLogin;
    }
    function setUserLogin($var)
    {
        $this->userLogin = $var;
    }

    function getUserPassword()
    {
        return $this->userPassword;
    }
    function setUserPassword($var)
    {
        $this->userPassword = $var;
    }

    function getAddress()
    {
        return $this->address;
    }
    function setAddress($var)
    {
        $this->address = $var;
    }

    function getGender()
    {
        return $this->gender;
    }
    function setGender($var)
    {
        $this->gender = $var;
    }

    function getBirthdate()
    {
        return $this->birthdate;
    }
    function setBirthdate($var)
    {
        $this->birthdate = $var;
    }

    function getCitizenCard()
    {
        return $this->citizenCard;
    }
    function setCitizenCard($var)
    {
        $this->citizenCard = $var;
    }

    function getUserType()
    {
        return $this->userType;
    }
    function setUserType($var)
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

    public function toString() : string {
        return "{id: $this->userId, name: $this->userName, login: $this->userLogin, password: $this->userPassword, "
            . "address: $this->address, gender: " . ($this->gender)->getUserGender() . ", birthdate: "
            . ($this->birthdate)->getTimestamp() . ", citizenCard: $this->citizenCard, userType: " . ($this->userType)->getUserType()
            .", isActive: $this->isActive}";
    }
}
