<?php
include 'api/config/includes.php';

class UserDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function openConnection() :void{
        $this->conn = (new Database())->getConnection();
    }
    public function closeConnection(): void
    {
        echo 'fechando conexão';
        $this->conn = null;
    }
    public function getConnection(): ?PDO{
        return $this->conn;
    }

    /// Create
    public function add($name, $userLogin, $userPassword, $address, $gender, $birthdate, $citizenCard, $userType, $isActive) :bool
    {
        if ($this->conn == null) $this->openConnection();
        $sttm = $this->conn->prepare('INSERT INTO user(name, userLogin, userPassword, address, gender, '
            . 'birthdate, citizenCard, userType, isActive) VALUES (:userName, :userLogin, :userPassword, '
            . ':address, :gender, :birthdate, :citizenCard, :userType, :isActive)');
        $sttm->bindValue(':userName', $name);
        $sttm->bindValue(':userLogin', $userLogin);
        $sttm->bindValue(':userPassword', $userPassword);
        $sttm->bindValue(':address', $address);
        $sttm->bindValue(':gender', $gender);
        $sttm->bindValue(':birthdate', $birthdate * 1000);
        $sttm->bindValue(':citizenCard', $citizenCard);
        $sttm->bindValue(':userType', $userType);
        $sttm->bindValue(':isActive', $isActive);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }

    /// Read
    public function getById(int $userId): ?User
    {
        if ($this->conn == null) $this->openConnection();
        $sttm = $this->conn->prepare('SELECT * FROM user WHERE userId = :userId');
        $sttm->bindValue(':userId', $userId);

        $sttm->execute();
        $result = $sttm->fetch(PDO::FETCH_ASSOC);

        if (!$result) return null;
        else {
            $userGender = (new UserGenderDAO())->getById(intval($result['gender']));
            $userTye = (new UserTypeDAO())->getById(intval($result['userType']));
            return User::createWithId(
                intval($result['userId']),
                $result['name'],
                $result['userLogin'],
                $result['userPassword'],
                $result['address'],
                $userGender,
                (new DateTime())->setTimestamp(intval($result['birthdate'])),
                $result['citizenCard'],
                $userTye,
                boolval($result['isActive']),
            );
        }
        $sttm = null;
//        $this->closeConnection();
    }
    public function getByLogin(string $userLogin): ?User
    {
        if ($this->conn == null) $this->openConnection();
        $sttm = $this->conn->prepare('SELECT * FROM user WHERE userLogin = :userLogin');
        $sttm->bindValue(':userLogin', $userLogin);

        $sttm->execute();
        $result = $sttm->fetch(PDO::FETCH_ASSOC);

        if (!$result) return null;
        else {

            return User::createWithId(
                intval($result['userId']),
                $result['name'],
                $result['userLogin'],
                $result['userPassword'],
                $result['address'],
                (new UserGenderDAO())->getById(intval($result['gender'])),
                (new DateTime())->setTimestamp(doubleval($result['birthdate'])),
                $result['citizenCard'],
                (new UserTypeDAO())->getById(intval($result['userType'])),
                boolval($result['isActive']),
            );
        }
        $sttm = null;
//        $this->closeConnection();
    }
    public function login(string $userLogin, string $userPassword): ?User
    {
        if ($this->conn == null) $this->openConnection();
        $sttm = $this->conn->prepare('SELECT * FROM user WHERE userLogin = :userLogin AND userPassword = :userPassword');
        $sttm->bindValue(':userLogin', $userLogin);
        $sttm->bindValue(':userPassword', $userPassword);

        $sttm->execute();
        $result = $sttm->fetch(PDO::FETCH_ASSOC);

        if (!$result) return null;
        else {
            return User::createWithId(
                intval($result['userId']),
                $result['name'],
                $result['userLogin'],
                $result['userPassword'],
                $result['address'],
                (new UserGenderDAO())->getById(intval($result['gender'])),
                (new DateTime())->setTimestamp(doubleval($result['birthdate'])),
                $result['citizenCard'],
                (new UserTypeDAO())->getById(intval($result['userType'])),
                boolval($result['isActive']),
            );
        }
        $sttm = null;
//        $this->closeConnection();
    }

    /// Update
    public function update($userId, $name, $userLogin, $userPassword, $address, $gender, $birthdate, $citizenCard, $userType, $isActive) :bool
    {
        if ($this->conn == null) $this->openConnection();
        $sttm = $this->conn->prepare('UPDATE user SET userId = :userId, name = :userName, userLogin= :userLogin, '
            . 'userPassword= :userPassword, address= :address, gender= :gender, birthdate= :birthdate, '
            . 'citizenCard= :citizenCard, userType= :userType, isActive = :isActive WHERE :userId');
        $sttm->bindValue(':userId', $userId);
        $sttm->bindValue(':userName', $name);
        $sttm->bindValue(':userLogin', $userLogin);
        $sttm->bindValue(':userPassword', $userPassword);
        $sttm->bindValue(':address', $address);
        $sttm->bindValue(':gender', $gender);
        $sttm->bindValue(':birthdate', $birthdate * 1000);
        $sttm->bindValue(':citizenCard', $citizenCard);
        $sttm->bindValue(':userType', $userType);
        $sttm->bindValue(':isActive', $isActive);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }
    public function deactivate($userId) :bool
    {
        if ($this->conn == null) $this->openConnection();
        $sttm = $this->conn->prepare('UPDATE user SET isActive = false WHERE :userId');
        $sttm->bindValue(':userId', $userId);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }
    public function active($userId) :bool
    {
        if ($this->conn == null) $this->openConnection();
        $sttm = $this->conn->prepare('UPDATE user SET isActive = true WHERE :userId');
        $sttm->bindValue(':userId', $userId);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }

    /// Delete
    public function delete(int $userId) :bool
    {
        if ($this->conn == null) $this->openConnection();
        $sttm = $this->conn->prepare('DELETE FROM user WHERE userId = :userId');
        $sttm->bindValue(':userId', $userId);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }
}