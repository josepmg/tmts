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

    public function __construct()
    {
    }
    public static function create($name, $userLogin, $userPassword, $address, $gender, $birthdate, $citizenCard, $userType, $isActive)
    {
        $instance = new User();
        $instance->setUserName($name);
        $instance->setUserLogin($userLogin);
        $instance->setUserPassword($userPassword);
        $instance->setAddress($address);
        $instance->setGender($gender);
        $instance->setBirthdate($birthdate);
        $instance->setCitizenCard($citizenCard);
        $instance->setUserType($userType);
        $instance->setIsActive($isActive);
        return $instance;
    }
    public static function createWithId($userId, $name, $userLogin, $userPassword, $address, $gender, $birthdate, $citizenCard, $userType, $isActive): User
    {
        $instance = new User();
        $instance->setUserId($userId);
        $instance->setUserName($name);
        $instance->setUserLogin($userLogin);
        $instance->setUserPassword($userPassword);
        $instance->setAddress($address);
        $instance->setGender($gender);
        $instance->setBirthdate($birthdate);
        $instance->setCitizenCard($citizenCard);
        $instance->setUserType($userType);
        $instance->setIsActive($isActive);
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

    function getUserName(): string
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

    public function toString(): string
    {
        return "{id: $this->userId, name: $this->userName, login: $this->userLogin, password: $this->userPassword, "
            . "address: $this->address, gender: " . ($this->gender)->getUserGender() . ", birthdate: "
            . ($this->birthdate)->getTimestamp() . ", citizenCard: $this->citizenCard, userType: " . ($this->userType)->getUserType()
            . ", isActive: $this->isActive}";
    }

    public function toJson(): array
    {
        $map = [];
        if ($this->userId != null) $map['userId'] = $this->userId;
        if ($this->userName != null) $map['userName'] = $this->userName;
        if ($this->userLogin != null) $map['userLogin'] = $this->userLogin;
        if ($this->userPassword != null) $map['userPassword'] = $this->userPassword;
        if ($this->address != null) $map['address'] = $this->address;
        if ($this->gender != null) $map['gender'] = ($this->gender)->toJson();
        if ($this->birthdate != null) $map['birthdate'] = ($this->birthdate)->getTimestamp();
        if ($this->citizenCard != null) $map['citizenCard'] = $this->citizenCard;
        if ($this->userType != null) $map['userType'] = ($this->userType)->toJson();
        if ($this->isActive != null) $map['isActive'] = $this->isActive;
        return $map;
    }
    public function credentialsToJson() : array{
        $map = [];
        if ($this->userId != null) $map['userId'] = $this->userId;
        if ($this->userName != null) $map['userName'] = $this->userName;
        if ($this->userLogin != null) $map['userLogin'] = $this->userLogin;
        if ($this->userType != null) $map['userType'] = ($this->userType)->getUserType();

        return $map;
    }
    public static function listToJson(array $list) : ?array {
        if ($list == null) return null;
        $map = [];
        foreach ($list as $listElement){
            array_push($map, $listElement->toJson());
        }
        return $map;
    }
}
