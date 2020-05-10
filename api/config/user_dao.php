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
    public function addUser(User $u)
    {
        $sttm = $this->conn->prepare('INSERT INTO user(name, userLogin, userPassword, address, gender, '
            . 'birthdate, citizenCard, userType, isActive) VALUES (:userName, :userLogin, :userPassword, '
            . ':address, :gender, :birthdate, :citizenCard, :userType, :isActive)');
        $sttm->bindValue(':userName', $u->get_userName());
        $sttm->bindValue(':userLogin', $u->get_userLogin());
        $sttm->bindValue(':userPassword', $u->get_userPassword());
        $sttm->bindValue(':address', $u->get_address());
        $sttm->bindValue(':gender', ($u->get_gender())->getUserGenderId());
        $sttm->bindValue(':birthdate', (($u->get_birthdate())->getTimestamp()) * 1000);
        $sttm->bindValue(':citizenCard', $u->get_citizenCard());
        $sttm->bindValue(':userType', ($u->get_userType())->getUserTypeId());
        $sttm->bindValue(':isActive', $u->isActive());

        $sttm->execute();
        $inserted = $sttm->fetchAll();

        $sttm = null;
//        $this->closeConection();
    }

    /// Read
    public function getUserByLogin(string $userLogin): ?User
    {
        $sttm = $this->conn->prepare('SELECT * FROM user WHERE userLogin = :userLogin');
        $sttm->bindValue(':userLogin', $userLogin);

        $sttm->execute();
        $result = $sttm->fetch(PDO::FETCH_ASSOC);

        if (!$result) return null;
        else {
            $userGender = (new UserGenderDAO())->getGenderById(intval($result['gender']));
            $userTye = (new UserTypeDAO())->getTypeById(intval($result['userType']));
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
    public function updateType(User $u)
    {
        $sttm = $this->conn->prepare('UPDATE user SET userId = :userId, name = :name, userLogin= :userLogin, '
            . 'userPassword= :userPassword, address= :address, gender= :gender, birthdate= :birthdate, '
            . 'citizenCard= :citizenCard, userType= :userType, isActive = :isActive WHERE :userId');
        $sttm->bindValue(':userName', $u->get_userName());
        $sttm->bindValue(':userLogin', $u->get_userLogin());
        $sttm->bindValue(':userPassword', $u->get_userPassword());
        $sttm->bindValue(':address', $u->get_address());
        $sttm->bindValue(':gender', ($u->get_gender())->getUserGenderId());
        $sttm->bindValue(':birthdate', (($u->get_birthdate())->getTimestamp()) * 1000);
        $sttm->bindValue(':citizenCard', $u->get_citizenCard());
        $sttm->bindValue(':userType', ($u->get_userType())->getUserTypeId());
        $sttm->bindValue(':isActive', $u->isActive());
        $sttm->bindValue(':userId', $u->get_userId());

        $sttm->execute();

        $sttm = null;
//        $this->closeConection();
    }

    /// Delete
    public function deleteUser(User $u)
    {
        $sttm = $this->conn->prepare('DELETE FROM user WHERE userId = :userId');
        $sttm->bindValue(':userId', $u->get_userId());

        $sttm->execute();

        $sttm = null;

    }
}