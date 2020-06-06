<?php
include 'api/config/includes.php';
class UserController{

    /// Create
    public static function createExam(int $type, int $patient, int $doctor, int $techinitian, double $realizationDate, array $examImages, array $examNotes): string{
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
            $result['body'] = "Register not found";
        } else{
            $exam = (new ExamDAO())->add($type, $patient, $doctor, $techinitian, $realizationDate, $examImages, $examNotes);
            $result['statusCode'] = '200';
            $result['body'] = strval($exam);
        }
        return json_encode($result);
    }
    public static function createExamImage(string $examImagePath, int $examId): string{
        $result = [];
        if ($examImagePath == null || $examImagePath = '' ||
            $examId == null || $examId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else{
            $examImage = (new ExamImageDAO())->add($examImagePath, $examId);
            $result['statusCode'] = '200';
            $result['body'] = strval($examImage);
        }
        return json_encode($result);
    }
    public static function createExamNote(string $examNote, int $healthProfessional, int $examId): string{
        $result = [];
        if ($examNote == null || $examNote = '' ||
            $healthProfessional == null || $healthProfessional == 0 ||
            $examId == null || $examId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else{
            $examNote = (new ExamNoteDAO())->add($examNote, $healthProfessional, $examId);
            $result['statusCode'] = '200';
            $result['body'] = strval($examNote);
        }
        return json_encode($result);
    }
    public static function createExamType(string $examType): string{
        $result = [];
        if ($examType == null || $examType = '')
        {
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else{
            $examType = (new ExamTypeDAO())->add($examType);
            $result['statusCode'] = '200';
            $result['body'] = strval($examType);
        }
        return json_encode($result);
    }

    /// Read
    public static function getExamById(int $examId): string {
        $result = [];
        if ($examId == null || $examId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $exam = (new ExamDAO())->getById($examId);
            $result['statusCode'] = '200';
            $result['body'] = $exam->toJson();
        }
        return json_encode($result);
    }
    public static function getExamByPatiet(int $patientId): string {
        $result = [];
        if ($patientId == null || $patientId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $exam = (new ExamDAO())->getByPatiet($patientId);
            $result['statusCode'] = '200';
            $result['body'] = $exam->toJson();
        }
        return json_encode($result);
    }
    public static function getExamByDoctor(int $doctorId): string {
        $result = [];
        if ($doctorId == null || $doctorId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $exam = (new ExamDAO())->getByDoctor($doctorId);
            $result['statusCode'] = '200';
            $result['body'] = $exam->toJson();
        }
        return json_encode($result);
    }
    public static function getExamByTechinician(int $techinicianId): string {
        $result = [];
        if ($techinicianId == null || $techinicianId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $exam = (new ExamDAO())->getByTechinician($techinicianId);
            $result['statusCode'] = '200';
            $result['body'] = $exam->toJson();
        }
        return json_encode($result);
    }
    public static function getExamByType(int $examTypeId): string {
        $result = [];
        if ($examTypeId == null || $examTypeId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $exam = (new ExamDAO())->getByType($examTypeId);
            $result['statusCode'] = '200';
            $result['body'] = $exam->toJson();
        }
        return json_encode($result);
    }
    public static function getExamByRealizationDate(int $realizationDate): string {
        $result = [];
        if ($realizationDate == null || $realizationDate == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $exam = (new ExamDAO())->getByRealizationDate($realizationDate);
            $result['statusCode'] = '200';
            $result['body'] = $exam->toJson();
        }
        return json_encode($result);
    }
    public static function getExamImageById(int $examImageId): string {
        $result = [];
        if ($examImageId == null || $examImageId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $examImage = (new ExamImageDAO())->getById($examImageId);
            $result['statusCode'] = '200';
            $result['body'] = $examImage->toJson();
        }
        return json_encode($result);
    }
    public static function getExamImageByExam(int $examId): string {
        $result = [];
        if ($examId == null || $examId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $examImage = (new ExamImageDAO())->getByExam($examId);
            $result['statusCode'] = '200';
            $result['body'] = $examImage->toJson();
        }
        return json_encode($result);
    }
    public static function getExamNoteById(int $examNoteId): string {
        $result = [];
        if ($examNoteId == null || $examNoteId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $examNote = (new ExamNoteDAO())->getById($examNoteId);
            $result['statusCode'] = '200';
            $result['body'] = $examNote->toJson();
        }
        return json_encode($result);
    }
    public static function getExamNoteByExam(int $examId): string{
        $result = [];
        if ($examId == null || $examId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $examNote = (new ExamNoteDAO())->getByExam($examId);
            $result['statusCode'] = '200';
            $result['body'] = json_encode(ExamNote::listToJson($examNote));
        }
        return json_encode($result);
    }
    public static function getExamNoteByHealthProfessional(int $healthProfessionalId): string{
        $result = [];
        if ($healthProfessionalId == null || $healthProfessionalId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $examNote = (new ExamNoteDAO())->getByHealthProfessional($healthProfessionalId);
            $result['statusCode'] = '200';
            $result['body'] = json_encode(ExamNote::listToJson($examNote));
        }
        return json_encode($result);
    }
    public static function getExamTypeById(int $examTypeId): string{
        $result = [];
        if ($examTypeId == null || $examTypeId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $examType = (new ExamTypeDAO())->getById($examTypeId);
            $result['statusCode'] = '200';
            $result['body'] = $examType->toJson();
        }
        return json_encode($result);
    }
    public static function getExamTypeByType(string $examType): string{
        $result = [];
        if ($examType == null || $examType == ''){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $examType = (new ExamTypeDAO())->getByType($examType);
            $result['statusCode'] = '200';
            $result['body'] = $examType->toJson();
        }
        return json_encode($result);
    }

    /// Update
    public static function updateExam(int $examId, int $type, int $patient, int $doctor, int $techinitian, double $realizationDate): string {
        $result = [];
        if ($examId == null || $examId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $exam = (new ExamDAO())->update($examId, $type, $patient, $doctor, $techinitian, $realizationDate);
            $result['statusCode'] = '200';
            $result['body'] = strval($exam);
        }
        return json_encode($result);
    }
    public static function updateExamImage(int $examImageId, string $examImagePath, int $examId): string {
        $result = [];
        if ($examImageId == null || $examImageId == 0 ||
            $examImagePath == null || $examImagePath == '' ||
            $examId == null || $examId = 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $examImage = (new ExamImageDAO())->update($examImageId, $examImagePath, $examId);
            $result['statusCode'] = '200';
            $result['body'] = strval($examImage);
        }
        return json_encode($result);
    }
    public static function updateExamNote(int $examNoteId, string $examNote, int $healthProfessional, int $examId): string{
        $result = [];
        if ($examNoteId == null || $examNoteId == 0 ||
            $examNote == null || $examNote == '' ||
            $healthProfessional == null || $healthProfessional = 0 ||
            $examId == null || $examId = 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $examNote = (new ExamNoteDAO())->update($examNoteId, $examNote, $healthProfessional, $examId);
            $result['statusCode'] = '200';
            $result['body'] = strval($examNote);
        }
        return json_encode($result);
    }
    public static function updateExamType(int $examTypeId, string $examType): string{
        $result = [];
        if ($examTypeId == null || $examTypeId == 0 ||
            $examType == null || $examType == ''){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $examType = (new ExamTypeDAO())->update($examTypeId, $examType);
            $result['statusCode'] = '200';
            $result['body'] = strval($examType);
        }
        return json_encode($result);
    }

    /// Delete
    public static function deleteExam(int $examId): string{
        $result = [];
        if ($examId == null || $examId == 0){
            $result['statusCode'] = '404';
            $result['body'] = "Register not found";
        } else {
            $exam = (new ExamDAO())->delete($examId);
            $result['statusCode'] = '200';
            $result['body'] = strval($exam);
        }
        return json_encode($result);
    }
    public static function deleteExamImage(int $examImageId): string
    {
        $result = [];
        if ($examImageId == null || $examImageId == 0) {
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $examImage = (new ExamImageDAO())->delete($examImageId);
            $result['statusCode'] = '200';
            $result['body'] = strval($examImage);
        }
        return json_encode($result);
    }
    public static function deleteExamNote(int $examNoteId): string{
        $result = [];
        if ($examNoteId == null || $examNoteId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $examNote = (new ExamNoteDAO())->delete($examNoteId);
            $result['statusCode'] = '200';
            $result['body'] = strval($examNote);
        }
        return json_encode($result);
    }
    public static function deleteExamType(int $examTypeId): string{
        $result = [];
        if ($examTypeId == null || $examTypeId == 0){
            $result['statusCode'] = '400';
            $result['body'] = "Register not found";
        } else {
            $examType = (new ExamTypeDAO())->delete($examTypeId);
            $result['statusCode'] = '200';
            $result['body'] = strval($examType);
        }
        return json_encode($result);
    }
}