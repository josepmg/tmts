<?php
include "database.php";
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

    public function getUserByLogin(string $userLogin) {
        $sttm = $this->conn->prepare('SELECT * FROM user WHERE userLogin = :userLogin');
        $sttm->bindValue(':userLogin', $userLogin);

        $sttm->execute();
        $inserted = $sttm->fetchAll(PDO::FETCH_NAMED);
        print_r($inserted);

//        $this->closeConection();
    }

    public function addUser(User $u): User {
        $sttm = $this->conn->prepare('INSERT INTO '
            .'user(name, userLogin, userPassword, address, gender, birthdate, citizenCard, userType, isActive) '
            .'VALUES (:userName, :userLogin, :userPassword, :address, :gender, :birthdate, :citizenCard, :userType, :isActive)');
        $sttm->bindValue(':userName', $u->get_userName());
        $sttm->bindValue(':userLogin', $u->get_userLogin());
        $sttm->bindValue(':userPassword', $u->get_userPassword());
        $sttm->bindValue(':gender', ($u->get_gender())->getUserGenderId());
        $sttm->bindValue(':birthdate', ($u->get_birthdate())->getTimestamp());
        $sttm->bindValue(':citizenCard', $u->get_citizenCard());
        $sttm->bindValue(':userType', ($u->get_userType())->getUserTypeId());
        $sttm->bindValue(':isActive', $u->isActive());

        $sttm->execute();
        $inserted = $sttm->fetchAll();
        print_r($inserted);

        $this->closeConection();
    }


}