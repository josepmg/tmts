<?php
class Exam
{
    private $examId;
    private $type;
    private $patient;
    private $doctor;
    private $techinitian;
    private $realizationDate;
    private $imgPath;
    private $examNotes;

    public function __construct($examId, $type, $patient, $doctor, $techinitian, $realizationDate, $imgPath, $examNotes)
    {
        $this->examId = $examId;
        $this->type = $type;
        $this->patient = $patient;
        $this->doctor = $doctor;
        $this->techinitian = $techinitian;
        $this->realizationDate = $realizationDate;
        $this->imgPath = $imgPath;
        $this->examNotes = $examNotes;
    }

    function get_examId()
    {
        return $this->examId;
    }
    function set_examId($var)
    {
        $this->examId = $var;
    }

    function get_name()
    {
        return $this->type;
    }
    function set_name($var)
    {
        $this->type = $var;
    }

    function get_patient()
    {
        return $this->patient;
    }
    function set_patient($var)
    {
        $this->patient = $var;
    }

    function get_doctor()
    {
        return $this->doctor;
    }
    function set_doctor($var)
    {
        $this->doctor = $var;
    }

    function get_address()
    {
        return $this->techinitian;
    }
    function set_address($var)
    {
        $this->techinitian = $var;
    }

    function get_gender()
    {
        return $this->realizationDate;
    }
    function set_gender($var)
    {
        $this->realizationDate = $var;
    }

    function get_birthdate()
    {
        return $this->imgPath;
    }
    function set_birthdate($var)
    {
        $this->imgPath = $var;
    }

    function get_citizenCard()
    {
        return $this->examNotes;
    }
    function set_citizenCard($var)
    {
        $this->examNotes = $var;
    }
}
