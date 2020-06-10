<?php

    include_once 'api/controllers/exam_controller.php';
    include_once 'api/controllers/user_controller.php';

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET,POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    /// Verify type of request
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if ($requestMethod !== 'GET' || $requestMethod !== 'POST'){
        // TODO return invalid request
    }
    /// Get action from request
    $action = '';
    if($requestMethod == 'GET'){
        $action = $_GET['action'];
    } elseif ($requestMethod == 'POST'){
        $action = $_POST['action'];
    }

    /// Treat requested action
        switch ($action){
            case "createExam":
                break;
            case "getExamById":
                $result = ExamController::getExamById(
                    $_GET['examId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamByPatiet":
                $result = ExamController::getExamByPatiet(
                    $_GET['patientId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamByDoctor":
                $result = ExamController::getExamByDoctor(
                    $_GET['doctorId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamByTechinician":
                $result = ExamController::getExamByTechinician(
                    $_GET['techinicianId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamByType":
                break;
            case "getExamByRealizationDate":
                break;
            case "updateExam":
                break;
            case "deleteExam":
                break;
            case "createExamImage":
                break;
            case "getExamImageById":
                break;
            case "getExamImageByExam":
                break;
            case "updateExamImage":
                break;
            case "deleteExamImage":
                break;
            case "createExamNote":
                break;
            case "getExamNoteById":
                break;
            case "getExamNoteByExam":
                break;
            case "getExamNoteByHealthProfessional":
                break;
            case "updateExamNote":
                break;
            case "deleteExamNote":
                break;
            case "createExamType":
                break;
            case "getExamTypeById":
                break;
            case "getExamTypeByType":
                break;
            case "updateExamType":
                break;
            case "deleteExamType":
                break;
            case "createUser":
                $result = UserController::createUser(
                    $_POST['name'],
                    $_POST['userLogin'],
                    $_POST['userPassword'],
                    $_POST['address'],
                    $_POST['gender'],
                    $_POST['birthdate'],
                    $_POST['citizenCard'],
                    $_POST['userType'],
                    $_POST['isActive']
                );
                http_response_code($result['statusCode']);
                return json_encode($result['body']);
                break;
            case "getUserById":
                $result = UserController::getUserById(
                    $_GET['userId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getUserByLogin":
                break;
            case "doLogin":
                break;
            case "updateUser":
                break;
            case "deletUser":
                break;
            default:
                // TODO return invalid request
                break;
        }
