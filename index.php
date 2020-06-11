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
                $result = ExamController::createExam(
                    $_GET['type'],
                    $_GET['patient'],
                    $_GET['doctor'],
                    $_GET['techinitian'],
                    $_GET['realizationDate'],
                    $_GET['examImages'],
                    $_GET['examNotes']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
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
                $result = ExamController::getExamByType(
                    $_GET['examTypeId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamByRealizationDate":
                $result = ExamController::getExamByRealizationDate(
                    $_GET['realizationDate']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "updateExam":
                $result = ExamController::updateExam(
                    $_GET['examId'],
                    $_GET['type'],
                    $_GET['patient'],
                    $_GET['doctor'],
                    $_GET['techinitian'],
                    $_GET['realizationDate']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "deleteExam":
                $result = ExamController::deleteExam(
                    $_GET['examId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "createExamImage":
                $result = ExamController::createExamImage(
                    $_GET['examImagePath'],
                    $_GET['examId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamImageById":
                $result = ExamController::getExamImageById(
                    $_GET['examImageId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamImageByExam":
                $result = ExamController::getExamImageByExam(
                    $_GET['examId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "updateExamImage":
                $result = ExamController::updateExamImage(
                    $_GET['examImageId'],
                    $_GET['examImagePath'],
                    $_GET['examId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "deleteExamImage":
                $result = ExamController::deleteExamImage(
                    $_GET['examImageId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "createExamNote":
                $result = ExamController::createExamNote(
                    $_GET['examNote'],
                    $_GET['healthProfessional'],
                    $_GET['examId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamNoteById":
                $result = ExamController::getExamNoteById(
                    $_GET['examNoteId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamNoteByExam":
                $result = ExamController::getExamNoteByExam(
                    $_GET['examId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamNoteByHealthProfessional":
                $result = ExamController::getExamNoteByHealthProfessional(
                    $_GET['healthProfessionalId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "updateExamNote":
                $result = ExamController::updateExamNote(
                    $_GET['examNoteId'],
                    $_GET['examNote'],
                    $_GET['healthProfessional'],
                    $_GET['examId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "deleteExamNote":
                $result = ExamController::deleteExamNote(
                    $_GET['examNoteId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "createExamType":
                $result = ExamController::createExamType(
                    $_GET['examType']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamTypeById":
                $result = ExamController::getExamTypeById(
                    $_GET['examTypeId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamTypeByType":
                $result = ExamController::getExamTypeByType(
                    $_GET['examType']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "updateExamType":
                $result = ExamController::updateExamType(
                    $_GET['examTypeId'],
                    $_GET['examType']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "deleteExamType":
                $result = ExamController::deleteExamType(
                    $_GET['examTypeId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "createUser":
                $result = UserController::createUser(
                    $_GET['name'],
                    $_GET['userLogin'],
                    $_GET['userPassword'],
                    $_GET['address'],
                    $_GET['gender'],
                    $_GET['birthdate'],
                    $_GET['citizenCard'],
                    $_GET['userType'],
                    $_GET['isActive']
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
                $result = UserController::getUserByLogin(
                    $_GET['userLogin']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "doLogin":
                $result = UserController::doLogin(
                    $_GET['userLogin'],
                    $_GET['userPassword']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "updateUser":
                $result = UserController::updateUser(
                    $_GET['userId'],
                    $_GET['name'],
                    $_GET['userLogin'],
                    $_GET['userPassword'],
                    $_GET['address'],
                    $_GET['gender'],
                    $_GET['birthdate'],
                    $_GET['citizenCard'],
                    $_GET['userType'],
                    $_GET['isActive']
                );
                http_response_code($result['statusCode']);
                return json_encode($result['body']);
                break;
            case "deletUser":
                $result = UserController::deletUser(
                    $_GET['userId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            default:
                http_response_code(400);
                echo json_encode(["message" => "Invalid action"]);
                break;
        }
