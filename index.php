<?php
    session_start();

    include_once 'api/controllers/exam_controller.php';
    include_once 'api/controllers/user_controller.php';

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    /// Verify type of request
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if ($requestMethod != "GET" && $requestMethod != "POST"){
        http_response_code(400);
        echo ($requestMethod == "GET");
        echo json_encode(["message" => "Invalid request method"]);
    } else {
        /// Get type of Http Request
        $clientRequest = $requestMethod == "GET" ? $_GET : $_POST;

        /// Get action from request
        $action = $clientRequest['action'];

        /// Treat requested action
        switch ($action) {
            case "createExam":
                $result = ExamController::createExam(
                    $clientRequest['type'],
                    $clientRequest['patient'],
                    $clientRequest['doctor'],
                    $clientRequest['techinitian'],
                    $clientRequest['realizationDate'],
                    $clientRequest['examImages'],
                    $clientRequest['examNotes']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamById":
                $result = ExamController::getExamById(
                    $clientRequest['examId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamByPatiet":
                $result = ExamController::getExamByPatiet(
                    $clientRequest['patientId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamByDoctor":
                $result = ExamController::getExamByDoctor(
                    $clientRequest['doctorId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamByTechinician":
                $result = ExamController::getExamByTechinician(
                    $clientRequest['techinicianId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamByType":
                $result = ExamController::getExamByType(
                    $clientRequest['examTypeId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamByRealizationDate":
                $result = ExamController::getExamByRealizationDate(
                    $clientRequest['realizationDate']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "updateExam":
                $result = ExamController::updateExam(
                    $clientRequest['examId'],
                    $clientRequest['type'],
                    $clientRequest['patient'],
                    $clientRequest['doctor'],
                    $clientRequest['techinitian'],
                    $clientRequest['realizationDate']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "deleteExam":
                $result = ExamController::deleteExam(
                    $clientRequest['examId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "createExamImage":
                $result = ExamController::createExamImage(
                    $clientRequest['examImagePath'],
                    $clientRequest['examId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamImageById":
                $result = ExamController::getExamImageById(
                    $clientRequest['examImageId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamImageByExam":
                $result = ExamController::getExamImageByExam(
                    $clientRequest['examId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "updateExamImage":
                $result = ExamController::updateExamImage(
                    $clientRequest['examImageId'],
                    $clientRequest['examImagePath'],
                    $clientRequest['examId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "deleteExamImage":
                $result = ExamController::deleteExamImage(
                    $clientRequest['examImageId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "createExamNote":
                $result = ExamController::createExamNote(
                    $clientRequest['examNote'],
                    $clientRequest['healthProfessional'],
                    $clientRequest['examId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamNoteById":
                $result = ExamController::getExamNoteById(
                    $clientRequest['examNoteId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamNoteByExam":
                $result = ExamController::getExamNoteByExam(
                    $clientRequest['examId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamNoteByHealthProfessional":
                $result = ExamController::getExamNoteByHealthProfessional(
                    $clientRequest['healthProfessionalId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "updateExamNote":
                $result = ExamController::updateExamNote(
                    $clientRequest['examNoteId'],
                    $clientRequest['examNote'],
                    $clientRequest['healthProfessional'],
                    $clientRequest['examId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "deleteExamNote":
                $result = ExamController::deleteExamNote(
                    $clientRequest['examNoteId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "createExamType":
                $result = ExamController::createExamType(
                    $clientRequest['examType']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamTypeById":
                $result = ExamController::getExamTypeById(
                    $clientRequest['examTypeId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getExamTypeByType":
                $result = ExamController::getExamTypeByType(
                    $clientRequest['examType']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "updateExamType":
                $result = ExamController::updateExamType(
                    $clientRequest['examTypeId'],
                    $clientRequest['examType']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "deleteExamType":
                $result = ExamController::deleteExamType(
                    $clientRequest['examTypeId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "createUser":
                $result = UserController::createUser(
                    $clientRequest['name'],
                    $clientRequest['userLogin'],
                    $clientRequest['userPassword'],
                    $clientRequest['address'],
                    $clientRequest['gender'],
                    $clientRequest['birthdate'],
                    $clientRequest['citizenCard'],
                    $clientRequest['userType'],
                    $clientRequest['isActive']
                );
                http_response_code($result['statusCode']);
                return json_encode($result['body']);
                break;
            case "getUserById":
                $result = UserController::getUserById(
                    $clientRequest['userId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "getUserByLogin":
                $result = UserController::getUserByLogin(
                    $clientRequest['userLogin']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "doLogin":
                $result = UserController::doLogin(
                    $clientRequest['userLogin'],
                    $clientRequest['userPassword']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "doLogout":
                $result = UserController::doLogout();
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "updateUser":
                $result = UserController::updateUser(
                    $clientRequest['userId'],
                    $clientRequest['name'],
                    $clientRequest['userLogin'],
                    $clientRequest['userPassword'],
                    $clientRequest['address'],
                    $clientRequest['gender'],
                    $clientRequest['birthdate'],
                    $clientRequest['citizenCard'],
                    $clientRequest['userType'],
                    $clientRequest['isActive']
                );
                http_response_code($result['statusCode']);
                return json_encode($result['body']);
                break;
            case "deleteUser":
                $result = UserController::deleteUser(
                    $clientRequest['userId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "deactivateUser":
                $result = UserController::deactivateUser(
                    $clientRequest['userId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            case "activateUser":
                $result = UserController::activateUser(
                    $clientRequest['userId']
                );
                http_response_code($result['statusCode']);
                echo json_encode($result['body']);
                break;
            default:
                http_response_code(400);
                echo json_encode(["message" => "Invalid action"]);
                break;
        }
    }
