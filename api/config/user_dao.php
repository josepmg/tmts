<?php

class UserDAO
{
    private PDO $conn;

    public function __construct($conn)
    {
        $this->conn = (new Database())->getConnection();;
    }

    public function closeConection(): void
    {
        $this->conn = null;
    }

    public function addUser(User $u): void{
        $sttm = $this->conn->prepare("INSERT INTO user() VALUES ()");
    }


}