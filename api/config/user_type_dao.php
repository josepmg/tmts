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
    public function addUserType(UserType $t)
    {
        $sttm = $this->conn->prepare('INSERT INTO '
            . 'usertype(userType) '
            . 'VALUES (:userType)');
        $sttm->bindValue(':gender', $t->getUserType());

        $sttm->execute();
        $inserted = $sttm->fetchAll();

        $sttm = null;
//        $this->closeConection();
    }

    /// Read
    public function getTypeByName(string $userType): ?UserType
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
    public function getTypeById(int $userTypeId): ?UserType
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
    public function updateType(UserType $ut)
    {
        $sttm = $this->conn->prepare('UPDATE usertype SET userType = :userType WHERE userTypeId = :userTypeId');
        $sttm->bindValue(':userTypeId', $ut->getUserTypeId());
        $sttm->bindValue(':userType', $ut->getUserType());

        $sttm->execute();

        $sttm = null;
//        $this->closeConection();
    }

    /// Delete
    public function deleteType(UserType $ut)
    {
        $sttm = $this->conn->prepare('DELETE FROM usertype WHERE userTypeId = :userTypeId');
        $sttm->bindValue(':userTypeId', $ut->getUserTypeId());

        $sttm->execute();

        $sttm = null;
//        $this->closeConection();
    }

}