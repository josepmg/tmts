<?php
include 'api/config/includes.php';

class UserDAO
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
    public function add(User $u)
    {
        $sttm = $this->conn->prepare('INSERT INTO user(name, userLogin, userPassword, address, gender, '
            . 'birthdate, citizenCard, userType, isActive) VALUES (:userName, :userLogin, :userPassword, '
            . ':address, :gender, :birthdate, :citizenCard, :userType, :isActive)');
        $sttm->bindValue(':userName', $u->getUserName());
        $sttm->bindValue(':userLogin', $u->getUserLogin());
        $sttm->bindValue(':userPassword', $u->getUserPassword());
        $sttm->bindValue(':address', $u->getAddress());
        $sttm->bindValue(':gender', ($u->getGender())->getUserGenderId());
        $sttm->bindValue(':birthdate', (($u->getBirthdate())->getTimestamp()) * 1000);
        $sttm->bindValue(':citizenCard', $u->getCitizenCard());
        $sttm->bindValue(':userType', ($u->getUserType())->getUserTypeId());
        $sttm->bindValue(':isActive', $u->isActive());

        $sttm->execute();
        $inserted = $sttm->fetchAll();

        $sttm = null;
//        $this->closeConection();
    }

    /// Read
    public function getById(int $userId): ?User
    {
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
//        $this->closeConection();
    }
    public function getByLogin(string $userLogin): ?User
    {
        $sttm = $this->conn->prepare('SELECT * FROM user WHERE userLogin = :userLogin');
        $sttm->bindValue(':userLogin', $userLogin);

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
//        $this->closeConection();
    }

    /// Update
    public function update(User $u)
    {
        $sttm = $this->conn->prepare('UPDATE user SET userId = :userId, name = :name, userLogin= :userLogin, '
            . 'userPassword= :userPassword, address= :address, gender= :gender, birthdate= :birthdate, '
            . 'citizenCard= :citizenCard, userType= :userType, isActive = :isActive WHERE :userId');
        $sttm->bindValue(':userName', $u->getUserName());
        $sttm->bindValue(':userLogin', $u->getUserLogin());
        $sttm->bindValue(':userPassword', $u->getUserPassword());
        $sttm->bindValue(':address', $u->getAddress());
        $sttm->bindValue(':gender', ($u->getGender())->getUserGenderId());
        $sttm->bindValue(':birthdate', (($u->getBirthdate())->getTimestamp()) * 1000);
        $sttm->bindValue(':citizenCard', $u->getCitizenCard());
        $sttm->bindValue(':userType', ($u->getUserType())->getUserTypeId());
        $sttm->bindValue(':isActive', $u->isActive());
        $sttm->bindValue(':userId', $u->getUserId());

        $sttm->execute();

        $sttm = null;
//        $this->closeConection();
    }

    /// Delete
    public function delete(User $u)
    {
        $sttm = $this->conn->prepare('DELETE FROM user WHERE userId = :userId');
        $sttm->bindValue(':userId', $u->getUserId());

        $sttm->execute();

        $sttm = null;

    }
}