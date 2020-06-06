<?php
include 'api/config/includes.php';

class UserTypeDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();;
    }

    public function closeConection(): void
    {
        $this->conn = null;
    }

    /// Create
    public function add(string $userType): bool
    {
        $sttm = $this->conn->prepare('INSERT INTO '
            . 'usertype(userType) '
            . 'VALUES (:userType)');
        $sttm->bindValue(':userType', $userType);

        $result = $sttm->execute();
        $inserted = $sttm->fetchAll();
        $sttm = null;

        return $result;
    }

    /// Read
    public function getByType(string $userType): ?UserType
    {
        $sttm = $this->conn->prepare('SELECT * FROM usertype WHERE userType = :userType');
        $sttm->bindValue(':userType', $userType);

        $sttm->execute();
        $result = $sttm->fetch(PDO::FETCH_ASSOC);

        if (!$result) return null;
        else {
            return UserType::createWithId(
                intval($result['userTypeId']),
                $result['userType'],
            );
        }
        $sttm = null;
//        $this->closeConection();
    }
    public function getById(int $userTypeId): ?UserType
    {
        $sttm = $this->conn->prepare('SELECT * FROM usertype WHERE userTypeId = :userTypeId');
        $sttm->bindValue(':userTypeId', $userTypeId);

        $sttm->execute();
        $result = $sttm->fetch(PDO::FETCH_ASSOC);

        if (!$result) return null;
        else {
            return UserType::createWithId(
                intval($result['userTypeId']),
                $result['userType'],
            );
        }
        $sttm = null;
//        $this->closeConection();
    }

    /// Update
    public function update(int $userTypeId, string  $userType): bool
    {
        $sttm = $this->conn->prepare('UPDATE usertype SET userType = :userType WHERE userTypeId = :userTypeId');
        $sttm->bindValue(':userTypeId', $userTypeId);
        $sttm->bindValue(':userType', $userType);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }

    /// Delete
    public function delete(int $userTypeId): bool
    {
        $sttm = $this->conn->prepare('DELETE FROM usertype WHERE userTypeId = :userTypeId');
        $sttm->bindValue(':userTypeId', $userTypeId);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }

}