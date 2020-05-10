<?php


class UserType
{
    private int $userTypeId;
    private string $userType;

    public function __construct(string $userType)
    {
        $this->userType = $userType;
    }
    public static function createWithId(int $userTypeId, string $userType) : UserType{
        $instance = new UserType($userType);
        $instance->setUserTypeId($userTypeId);

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


}