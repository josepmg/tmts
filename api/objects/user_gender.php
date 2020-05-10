<?php


class UserGender
{
    private int $userGenderId;
    private string $userGender;

    public function __construct(string $userGender)
    {
        $this->userGender = $userGender;
    }
    public static function createWithId(int $userGenderId, string $userGender): UserGender{
        $instance = new UserGender($userGender);
        $instance->userGenderId = $userGenderId;
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



}