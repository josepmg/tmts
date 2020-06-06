<?php
include 'api/config/includes.php';

class UserGenderDAO
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
    public function add(string $userGender): bool
    {
        $sttm = $this->conn->prepare('INSERT INTO '
            . 'gendertype(gender) '
            . 'VALUES (:gender)');
        $sttm->bindValue(':gender', $userGender);

        $result = $sttm->execute();
        $inserted = $sttm->fetchAll();
        $sttm = null;

        return $result;
    }

    /// Read
    public function getByName(string $gender): ?UserGender
    {
        $sttm = $this->conn->prepare('SELECT * FROM gendertype WHERE gender = :gender');
        $sttm->bindValue(':gender', $gender);

        $sttm->execute();
        $result = $sttm->fetch(PDO::FETCH_ASSOC);

        if (!$result) return null;
        else {
            return UserGender::createWithId(
                intval($result['genderId']),
                $result['gender'],
            );
        }
        $sttm = null;
//        $this->closeConection();
    }
    public function getById(int $genderId): ?UserGender
    {
        $sttm = $this->conn->prepare('SELECT * FROM gendertype WHERE genderId = :genderId');
        $sttm->bindValue(':genderId', $genderId);

        $sttm->execute();
        $result = $sttm->fetch(PDO::FETCH_ASSOC);

        if (!$result) return null;
        else {
            return UserGender::createWithId(
                intval($result['genderId']),
                $result['gender'],
            );
        }
        $sttm = null;
//        $this->closeConection();
    }

    /// Update
    public function update(int $userGenderId, string $userGender): bool
    {
        $sttm = $this->conn->prepare('UPDATE gendertype SET gender = :gender WHERE genderId = :genderId');
        $sttm->bindValue(':genderId', $userGenderId);
        $sttm->bindValue(':gender', $userGender);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }

    /// Delete
    public function delete(int $userGenderId): bool
    {
        $sttm = $this->conn->prepare('DELETE FROM gendertype WHERE genderId = :genderId');
        $sttm->bindValue(':genderId', $userGenderId);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }



}