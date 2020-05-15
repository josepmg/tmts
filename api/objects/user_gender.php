<?php


class UserGender
{
    private int $userGenderId;
    private string $userGender;

    public function __construct(){}
    public static function create(string $userGender)
    {
        $instance = new UserGender();
        $instance->setUserGender($userGender);
        return $instance;
    }
    public static function createWithId(int $userGenderId, string $userGender): UserGender{
        $instance = new UserGender();
        $instance->setUserGenderId($userGenderId);
        $instance->setUserGender($userGender);
        return $instance;
    }

    public function getUserGenderId(): int
    {
        return $this->userGenderId;
    }
    public function setUserGenderId(int $userGenderId): void
    {
        $this->userGenderId = $userGenderId;
    }

    public function getUserGender(): string
    {
        return $this->userGender;
    }
    public function setUserGender(string $userGender): void
    {
        $this->userGender = $userGender;
    }

    public function toJson() : array {
        $map = [];
        if ($this->userGenderId != null) $map['userGenderId'] = $this->userGenderId;
        if ($this->userGender != null) $map['userGender'] = $this->userGender;

        return $map;
    }

}