<?php
session_start();

include 'api/config/includes.php';
class UserController{

    public static function createUser($name, $userLogin, $userPassword, $address, $gender, $birthdate, $citizenCard, $userType, $isActive): array {
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
            $result['statusCode'] = 400;
            $result['body'] = ["message" => "Invalid input(s)"];
        } elseif (userController::checkSessionVariables() && userController::isAdmin()){
            $result['statusCode'] = '401';
            $result['body'] = ["message" => "Access not allowed"];
        } else {
            try {
                $user = (new UserDAO())->add($name, $userLogin, $userPassword, $address, $gender, $birthdate, $citizenCard, $userType, $isActive);
                $result['statusCode'] = '200';
                $result['body'] = strval($user);
            } catch (Exception $e) {
                $result['statusCode'] = '500';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return ($result);
    }

    public static function getUserById(int $userId): array {
        $result = [];
        if ($userId == null || $userId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $user = (new UserDAO())->getById($userId);
                if ($user != null) {
                    $result['body'] = ["result" => $user->toJson()];
                    $result['statusCode'] = '200';
                } else {
                    $result['body'] = ["message" => "No records found"];
                    $result['statusCode'] = '200';
                }
            } catch (Exception $e) {
                $result['statusCode'] = '500';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function getUserByLogin(string $userLogin): array {
        $result = [];
        if ($userLogin == null || $userLogin == ''){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $user = (new UserDAO())->getByLogin($userLogin);
                if ($user != null) {
                    $result['body'] = ["result" => $user->toJson()];
                    $result['statusCode'] = '200';
                } else {
                    $result['body'] = ["message" => "No records found"];
                    $result['statusCode'] = '200';
                }
            } catch (Exception $e) {
                $result['statusCode'] = '500';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function doLogin(string $userLogin, string $userPassword): array {
        $result = [];
        if ($userLogin == null || $userLogin == '' || $userPassword == null || $userPassword == ''){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $user = (new UserDAO())->login($userLogin, $userPassword);
                if ($user != null) {
                    $result['statusCode'] = '200';
                    $result['body'] = ["result" => $user->toJson()];

                    $_SESSION['userId'] = $user->getUserId();
                    $_SESSION['userName']  = $user->getUserName();
                    $_SESSION['userLogin']  = $user->getUserLogin();
                    $_SESSION['userType'] = ($user->getUserType())->getUserTypeId();
                } else {
                    $result['statusCode'] = '204';
                    $result['body'] = ["message" => "No records found"];
                }
            } catch (Exception $e) {
                $result['statusCode'] = '500';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function doLogout(): array {
        $result = [];
        try {
            session_unset();
            session_destroy();
            $result["result"] = "true";
        } catch (Exception $e) {
            $result['statusCode'] = '500';
            $result['body'] = ["message" => $e->getMessage()];
        }
        return  ($result);
    }

    public static function updateUser(int $userId, string $name, string $userLogin, string $userPassword, string $address, int $gender, double $birthdate, string $citizenCard, int $userType, bool $isActive): array {
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
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $user = (new UserDAO())->update($userId, $name, $userLogin, $userPassword, $address, $gender, $birthdate, $citizenCard, $userType, $isActive);
                $result['statusCode'] = '200';
                $result['body'] = strval($user);
            } catch (Exception $e) {
                $result['statusCode'] = '500';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function deactivateUser(int $userId): array {
        $result = [];
        if ($userId == null || $userId == 0){
            $result['statusCode'] = '404';
            $result['body'] = ["message" => "Invalid input(s)"];
        } elseif (userController::checkSessionVariables() && userController::isAdmin()){
            $result['statusCode'] = '401';
            $result['body'] = ["message" => "Access not allowed"];
        } else {
            try {
                $user = (new UserDAO())->deactivate($userId);
                $result['statusCode'] = '200';
                $result['body'] = strval($user);
            } catch (Exception $e) {
                $result['statusCode'] = '500';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function activateUser(int $userId): array {
        $result = [];
        if ($userId == null || $userId == 0){
            $result['statusCode'] = '404';
            $result['body'] = ["message" => "Invalid input(s)"];
        } elseif (userController::checkSessionVariables() && userController::isAdmin()){
            $result['statusCode'] = '401';
            $result['body'] = ["message" => "Access not allowed"];
        } else {
            try {
                $user = (new UserDAO())->active($userId);
                $result['statusCode'] = '200';
                $result['body'] = strval($user);
            } catch (Exception $e) {
                $result['statusCode'] = '500';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }

    public static function deleteUser(int $userId): array {
        $result = [];
        if ($userId == null || $userId == 0){
            $result['statusCode'] = '404';
            $result['body'] = ["message" => "Invalid input(s)"];
        } elseif (userController::checkSessionVariables() && userController::isAdmin()){
            $result['statusCode'] = '401';
            $result['body'] = ["message" => "Access not allowed"];
        } else {
            try {
                $user = (new UserDAO())->delete($userId);
                $result['statusCode'] = '200';
                $result['body'] = strval($user);
            } catch (Exception $e) {
                $result['statusCode'] = '500';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }

    private static function checkSessionVariables(): bool{
        return (isset($_SESSION['userId']) ||
            isset($_SESSION['userName']) ||
            isset($_SESSION['userLogin']) ||
            isset($_SESSION['userType']));
    }
    private static function isAdmin(): bool{
        return (isset($_SESSION['userType']) && $_SESSION['userType'] == 1);
    }
}