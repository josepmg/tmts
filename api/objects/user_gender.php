<?php


class UserGender
{
    private int $userGenderId;
    private string $userGender;

    public function __construct(int $userGenderId, string $userGender)
    {
        $this->userGenderId = $userGenderId;
        $this->userGender = $userGender;
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