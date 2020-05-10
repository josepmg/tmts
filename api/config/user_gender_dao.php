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
    public function addUserGender(UserGender $g)
    {
        $sttm = $this->conn->prepare('INSERT INTO '
            . 'gendertype(gender) '
            . 'VALUES (:gender)');
        $sttm->bindValue(':gender', $g->getUserGender());

        $sttm->execute();
        $inserted = $sttm->fetchAll();

        $sttm = null;
//        $this->closeConection();
    }

    /// Read
    public function getGenderByName(string $gender): ?UserGender
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
    public function getGenderById(int $genderId): ?UserGender
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
    public function updateType(UserGender $ug)
    {
        $sttm = $this->conn->prepare('UPDATE gendertype SET gender = :gender WHERE genderId = :genderId');
        $sttm->bindValue(':genderId', $ug->getUserGenderId());
        $sttm->bindValue(':gender', $ug->getUserGender());

        $sttm->execute();

        $sttm = null;
//        $this->closeConection();
    }

    /// Delete
    public function deleteType(UserGender $ug)
    {
        $sttm = $this->conn->prepare('DELETE FROM gendertype WHERE genderId = :genderId');
        $sttm->bindValue(':genderId', $ug->getUserGenderId());

        $sttm->execute();

        $sttm = null;
//        $this->closeConection();
    }



}