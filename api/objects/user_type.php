<?php


class UserType
{
    private int $userTypeId;
    private string $userType;

    public function __construct(){}
    public static function create(string $userType)
    {
        $instance = new UserType();
        $instance->setUserType($userType);
        return $instance;
    }
    public static function createWithId(int $userTypeId, string $userType) : UserType{
        $instance = new UserType();
        $instance->setUserTypeId($userTypeId);
        $instance->setUserType($userType);
        return $instance;
    }

    public function getUserTypeId(): int
    {
        return $this->userTypeId;
    }
    public function setUserTypeId(int $userTypeId): void
    {
        $this->userTypeId = $userTypeId;
    }

    public function getUserType(): string
    {
        return $this->userType;
    }
    public function setUserType(string $userType): void
    {
        $this->userType = $userType;
    }

    public function toJson() : array {
        $map = [];
        if ($this->userTypeId != null) $map['userTypeId'] = $this->userTypeId;
        if ($this->userType != null) $map['userType'] = $this->userType;

        return $map;
    }

}