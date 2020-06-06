<?php
include 'api/config/includes.php';
class UserController{

    public static function createUser($name, $userLogin, $userPassword, $address, $gender, $birthdate, $citizenCard, $userType, $isActive): string {
        $result = [];
        if ($name == null || $name == '' ||
            $userLogin == null || $userLogin == '' ||
            $userPassword == null || $userPassword == '' ||
            $address == null || $address == '' ||
            $gender == null || $gender == 0 ||
            $birthdate == null || $birthdate == 0||
            $citizenCard == null || $citizenCard == '' ||
            $userType == null || $userType == 0 ||
            $isActive == null || $isActive == false){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $user = (new UserDAO())->add($name, $userLogin, $userPassword, $address, $gender, $birthdate, $citizenCard, $userType, $isActive);
            $result['statusCode'] = '200';
            $result['body'] = strval($user);
        }
        return json_encode($result);
    }

    public static function getUserById(int $userId): string {
        $result = [];
        if ($userId == null || $userId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $user = ( new UserDAO())->getById($userId);
            $result['statusCode'] = '200';
            $result['body'] = $user->toJson();
        }
        return json_encode($result);
    }
    public static function getUserByLogin(string $userLogin): string {
        $result = [];
        if ($userLogin == null || $userLogin == ''){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $user = ( new UserDAO())->getByLogin($userLogin);
            $result['statusCode'] = '200';
            $result['body'] = $user->toJson();
        }
        return json_encode($result);
    }
    public static function doLogin(string $userLogin, string $userPassword): string {
        $result = [];
        if ($userLogin == null || $userLogin == '' || $userPassword == null || $userPassword == ''){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $user = ( new UserDAO())->login($userLogin, $userPassword);
            $result['statusCode'] = '200';
            $result['body'] = $user->credentialsToJson();
        }
        return json_encode($result);
    }

    public static function updateUser(int $userId, string $name, string $userLogin, string $userPassword, string $address, int $gender, double $birthdate, string $citizenCard, int $userType, bool $isActive): string {
        $result = [];
        if ($userId == null || $userId == 0 ||
            $name == null || $name == '' ||
            $userLogin == null || $userLogin == '' ||
            $userPassword == null || $userPassword == '' ||
            $address == null || $address == '' ||
            $gender == null || $gender == 0 ||
            $birthdate == null || $birthdate == 0||
            $citizenCard == null || $citizenCard == '' ||
            $userType == null || $userType == 0 ||
            $isActive == null || $isActive == false ){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $user = (new UserDAO())->update($userId, $name, $userLogin, $userPassword, $address, $gender, $birthdate, $citizenCard, $userType, $isActive);
            $result['statusCode'] = '200';
            $result['body'] = strval($user);
        }
        return json_encode($result);
    }

    public static function deletUser(int $userId): string {
        $result = [];
        if ($userId == null || $userId == 0){
            $result['statusCode'] = '404';
            $result['body'] = "Register not found";
        } else {
            $user = (new UserDAO())->delete($userId);
            $result['statusCode'] = '200';
            $result['body'] = strval($user);
        }
        return json_encode($result);
    }
}