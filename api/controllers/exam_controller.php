<?php
include 'api/config/includes.php';
class ExamController{

    /// Create
    public static function createExam(int $type, int $patient, int $doctor, int $techinitian, double $realizationDate, array $examImages, array $examNotes): array{
        $result = [];
        if ($type == null || $type == 0 ||
            $patient == null || $patient == 0 ||
            $doctor == null || $doctor == 0 ||
            $techinitian == null || $techinitian == 0 ||
            $realizationDate == null || $realizationDate == 0 ||
            $examImages == null ||
            $examNotes == null)
        {
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } elseif (ExamController::checkSessionVariables() && ExamController::isProfessional()){
            $result['statusCode'] = '401';
            $result['body'] = ["message" => "Access not allowed"];
        } else{
            try {
                $exam = (new ExamDAO())->add($type, $patient, $doctor, $techinitian, $realizationDate, $examImages, $examNotes);
                $result['statusCode'] = '200';
                $result['body'] = strval($exam);
            } catch (Exception $e){
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function createExamImage(string $examImagePath, int $examId): array{
        $result = [];
        if ($examImagePath == null || $examImagePath = '' ||
            $examId == null || $examId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } elseif (ExamController::checkSessionVariables() && ExamController::isProfessional()){
            $result['statusCode'] = '401';
            $result['body'] = ["message" => "Access not allowed"];
        } else{
            try {
                $examImage = (new ExamImageDAO())->add($examImagePath, $examId);
                $result['statusCode'] = '200';
                $result['body'] = strval($examImage);
            } catch (Exception $e)
            {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
            $result['statusCode'] = '200';
            $result['body'] = strval($examImage);
        }
        return ($result);
    }
    public static function createExamNote(string $examNote, int $healthProfessional, int $examId): array{
        $result = [];
        if ($examNote == null || $examNote = '' ||
            $healthProfessional == null || $healthProfessional == 0 ||
            $examId == null || $examId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } elseif (ExamController::checkSessionVariables() && ExamController::isProfessional()){
            $result['statusCode'] = '401';
            $result['body'] = ["message" => "Access not allowed"];
        } else{
            try {
                $examNote = (new ExamNoteDAO())->add($examNote, $healthProfessional, $examId);
                $result['statusCode'] = '200';
                $result['body'] = strval($examNote);
            } catch (Exception $e){
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
            $result['statusCode'] = '200';
            $result['body'] = strval($examNote);
        }
        return  ($result);
    }
    public static function createExamType(string $examType): array{
        $result = [];
        if ($examType == null || $examType = '')
        {
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } elseif (ExamController::checkSessionVariables() && ExamController::isProfessional()){
            $result['statusCode'] = '401';
            $result['body'] = ["message" => "Access not allowed"];
        } else{
            try {
                $examType = (new ExamTypeDAO())->add($examType);
                $result['statusCode'] = '200';
                $result['body'] = strval($examType);
            } catch (Exception $e){
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
            $result['statusCode'] = '200';
            $result['body'] = strval($examType);
        }
        return  ($result);
    }

    /// Read
    public static function getExamById(int $examId): array {
        $result = [];
        if ($examId == null || $examId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $exam = (new ExamDAO())->getById($examId);
                if ($exam != null) {
                    $result['statusCode'] = '200';
                    $result['body'] = ["result" => $exam->toJson()];
                } else {
                    $result['statusCode'] = '204';
                    $result['body'] = ["message" => "No records found"];
                }
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function getExamByPatiet(int $patientId): array {
        $result = [];
        if ($patientId == null || $patientId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $exam = (new ExamDAO())->getByPatiet($patientId);
                if (count($exam) > 0) {
                    $result['statusCode'] = '200';
                    $result['body'] = ["result" => Exam::listToJson($exam)];
                } else {
                    $result['statusCode'] = '204';
                    $result['body'] = ["message" => "No records found"];
                }
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function getExamByDoctor(int $doctorId): array {
        $result = [];
        if ($doctorId == null || $doctorId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $exam = (new ExamDAO())->getByDoctor($doctorId);
                if (count($exam) > 0) {
                    $result['statusCode'] = '200';
                    $result['body'] = ["result" => Exam::listToJson($exam)];
                } else {
                    $result['statusCode'] = '204';
                    $result['body'] = ["message" => "No records found"];
                }
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function getExamByTechinician(int $techinicianId): array {
        $result = [];
        if ($techinicianId == null || $techinicianId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $exam = (new ExamDAO())->getByTechinician($techinicianId);
                if (count($exam) > 0) {
                    $result['statusCode'] = '200';
                    $result['body'] = ["result" => Exam::listToJson($exam)];
                } else {
                    $result['statusCode'] = '204';
                    $result['body'] = ["message" => "No records found"];
                }
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function getExamByType(int $examTypeId): array {
        $result = [];
        if ($examTypeId == null || $examTypeId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $exam = (new ExamDAO())->getByType($examTypeId);
                if (count($exam) > 0) {
                    $result['statusCode'] = '200';
                    $result['body'] = ["result" => Exam::listToJson($exam)];
                } else {
                    $result['statusCode'] = '204';
                    $result['body'] = ["message" => "No records found"];
                }
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function getExamByRealizationDate(int $realizationDate): array {
        $result = [];
        if ($realizationDate == null || $realizationDate == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $exam = (new ExamDAO())->getByRealizationDate($realizationDate);
                if (count($exam) > 0) {
                    $result['statusCode'] = '200';
                    $result['body'] = ["result" => Exam::listToJson($exam)];
                } else {
                    $result['statusCode'] = '204';
                    $result['body'] = ["message" => "No records found"];
                }
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function getExamImageById(int $examImageId): array {
        $result = [];
        if ($examImageId == null || $examImageId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $examImage = (new ExamImageDAO())->getById($examImageId);
                if ($examImage != null) {
                    $result['statusCode'] = '200';
                    $result['body'] = ["result" => $examImage->toJson()];
                } else{
                    $result['statusCode'] = '204';
                    $result['body'] = ["message" => "No records found"];
                }
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function getExamImageByExam(int $examId): array {
        $result = [];
        if ($examId == null || $examId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $examImage = (new ExamImageDAO())->getByExam($examId);
                if (count($examImage) > 0) {
                    $result['statusCode'] = '200';
                    $result['body'] = ["result" => ExamImage::listToJson($examImage)];
                } else{
                    $result['statusCode'] = '204';
                    $result['body'] = ["message" => "No records found"];
                }
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function getExamNoteById(int $examNoteId): array {
        $result = [];
        if ($examNoteId == null || $examNoteId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $examNote = (new ExamNoteDAO())->getById($examNoteId);
                if ($examNote != null) {
                    $result['statusCode'] = '200';
                    $result['body'] = ["result" => $examNote->toJson()];
                } else{
                    $result['statusCode'] = '204';
                    $result['body'] = ["message" => "No records found"];
                }
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function getExamNoteByExam(int $examId): array{
        $result = [];
        if ($examId == null || $examId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $examNote = (new ExamNoteDAO())->getByExam($examId);
                if (count($examNote) > 0) {
                    $result['statusCode'] = '200';
                    $result['body'] = ["result" => ExamNote::listToJson($examNote)];
                } else{
                    $result['statusCode'] = '204';
                    $result['body'] = ["message" => "No records found"];
                }
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function getExamNoteByHealthProfessional(int $healthProfessionalId): array{
        $result = [];
        if ($healthProfessionalId == null || $healthProfessionalId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $examNote = (new ExamNoteDAO())->getByHealthProfessional($healthProfessionalId);
                if (count($examNote) > 0) {
                    $result['statusCode'] = '200';
                    $result['body'] = ["result" => ExamNote::listToJson($examNote)];
                } else{
                    $result['statusCode'] = '204';
                    $result['body'] = ["message" => "No records found"];
                }
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function getExamTypeById(int $examTypeId): array{
        $result = [];
        if ($examTypeId == null || $examTypeId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $examType = (new ExamTypeDAO())->getById($examTypeId);
                if ($examType != null) {
                    $result['statusCode'] = '200';
                    $result['body'] = ["result" => $examType->toJson()];
                } else{
                    $result['statusCode'] = '204';
                    $result['body'] = ["message" => "No records found"];
                }
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function getExamTypeByType(string $examType): array{
        $result = [];
        if ($examType == null || $examType == ''){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } else {
            try {
                $examType = (new ExamTypeDAO())->getByType($examType);
                if ($examType != null) {
                    $result['statusCode'] = '200';
                    $result['body'] = ["result" => $examType->toJson()];
                } else{
                    $result['statusCode'] = '204';
                    $result['body'] = ["message" => "No records found"];
                }
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }

    /// Update
    public static function updateExam(int $examId, int $type, int $patient, int $doctor, int $techinitian, double $realizationDate): array {
        $result = [];
        if ($examId == null || $examId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } elseif (ExamController::checkSessionVariables() && ExamController::isProfessional()){
            $result['statusCode'] = '401';
            $result['body'] = ["message" => "Access not allowed"];
        } else {
            try {
                $exam = (new ExamDAO())->update($examId, $type, $patient, $doctor, $techinitian, $realizationDate);
                $result['statusCode'] = '200';
                $result['body'] = strval($exam);
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function updateExamImage(int $examImageId, string $examImagePath, int $examId): array {
        $result = [];
        if ($examImageId == null || $examImageId == 0 ||
            $examImagePath == null || $examImagePath == '' ||
            $examId == null || $examId = 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } elseif (ExamController::checkSessionVariables() && ExamController::isProfessional()){
            $result['statusCode'] = '401';
            $result['body'] = ["message" => "Access not allowed"];
        } else {
            try {
                $examImage = (new ExamImageDAO())->update($examImageId, $examImagePath, $examId);
                $result['statusCode'] = '200';
                $result['body'] = strval($examImage);
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function updateExamNote(int $examNoteId, string $examNote, int $healthProfessional, int $examId): array{
        $result = [];
        if ($examNoteId == null || $examNoteId == 0 ||
            $examNote == null || $examNote == '' ||
            $healthProfessional == null || $healthProfessional = 0 ||
            $examId == null || $examId = 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } elseif (ExamController::checkSessionVariables() && ExamController::isProfessional()){
            $result['statusCode'] = '401';
            $result['body'] = ["message" => "Access not allowed"];
        } else {
            try {
                $examNote = (new ExamNoteDAO())->update($examNoteId, $examNote, $healthProfessional, $examId);
                $result['statusCode'] = '200';
                $result['body'] = strval($examNote);
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function updateExamType(int $examTypeId, string $examType): array{
        $result = [];
        if ($examTypeId == null || $examTypeId == 0 ||
            $examType == null || $examType == ''){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } elseif (ExamController::checkSessionVariables() && ExamController::isProfessional()){
            $result['statusCode'] = '401';
            $result['body'] = ["message" => "Access not allowed"];
        } else {
            try {
                $examType = (new ExamTypeDAO())->update($examTypeId, $examType);
                $result['statusCode'] = '200';
                $result['body'] = strval($examType);
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }

    /// Delete
    public static function deleteExam(int $examId): array{
        $result = [];
        if ($examId == null || $examId == 0){
            $result['statusCode'] = '404';
            $result['body'] = ["message" => "Invalid input(s)"];
        } elseif (ExamController::checkSessionVariables() && ExamController::isAdmin()){
            $result['statusCode'] = '401';
            $result['body'] = ["message" => "Access not allowed"];
        } else {
            try {
                $exam = (new ExamDAO())->delete($examId);
                $result['statusCode'] = '200';
                $result['body'] = strval($exam);
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function deleteExamImage(int $examImageId): array
    {
        $result = [];
        if ($examImageId == null || $examImageId == 0) {
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } elseif (ExamController::checkSessionVariables() && ExamController::isAdmin()){
            $result['statusCode'] = '401';
            $result['body'] = ["message" => "Access not allowed"];
        } else {
            try {
                $examImage = (new ExamImageDAO())->delete($examImageId);
                $result['statusCode'] = '200';
                $result['body'] = strval($examImage);
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function deleteExamNote(int $examNoteId): array{
        $result = [];
        if ($examNoteId == null || $examNoteId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } elseif (ExamController::checkSessionVariables() && ExamController::isAdmin()){
            $result['statusCode'] = '401';
            $result['body'] = ["message" => "Access not allowed"];
        } else {
            try {
                $examNote = (new ExamNoteDAO())->delete($examNoteId);
                $result['statusCode'] = '200';
                $result['body'] = strval($examNote);
            } catch (Exception $e) {
                $result['statusCode'] = '501';
                $result['body'] = ["message" => $e->getMessage()];
            }
        }
        return  ($result);
    }
    public static function deleteExamType(int $examTypeId): array{
        $result = [];
        if ($examTypeId == null || $examTypeId == 0){
            $result['statusCode'] = '400';
            $result['body'] = ["message" => "Invalid input(s)"];
        } elseif (ExamController::checkSessionVariables() && ExamController::isAdmin()){
            $result['statusCode'] = '401';
            $result['body'] = ["message" => "Access not allowed"];
        } else {
            try {
                $examType = (new ExamTypeDAO())->delete($examTypeId);
                $result['statusCode'] = '200';
                $result['body'] = strval($examType);
            } catch (Exception $e) {
                $result['statusCode'] = '501';
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

    private static function isProfessional(): bool{
        return (isset($_SESSION['userType']) && $_SESSION['userType'] != 4);
    }

    private static function isAdmin(): bool{
        return (isset($_SESSION['userType']) && $_SESSION['userType'] == 1);
    }
}