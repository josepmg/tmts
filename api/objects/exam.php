<?php
include 'api/config/includes.php';

class Exam {
    private int $examId;
    private ExamType $type;
    private User $patient;
    private User $doctor;
    private User $techinitian;
    private DateTime $realizationDate;
    private array $examImages;
    private array $examNotes;

    public function __construct($type, $patient, $doctor, $techinitian, $realizationDate, $examImages, $examNotes)
    {
        $this->type = $type;
        $this->patient = $patient;
        $this->doctor = $doctor;
        $this->techinitian = $techinitian;
        $this->realizationDate = $realizationDate;
        $this->examImages = $examImages ??[];
        $this->examNotes = $examNotes ?? [];
    }
    public static function createWithId($examId, $type, $patient, $doctor, $techinitian, $realizationDate, $examImages, $examNotes){
        $instance = new Exam($type, $patient, $doctor, $techinitian, $realizationDate, $examImages, $examNotes);
        $instance->setExamId($examId);

        return $instance;
    }

    public function getExamId(): int
    {
        return $this->examId;
    }
    public function setExamId(int $examId): void
    {
        $this->examId = $examId;
    }

    public function getType(): ExamType
    {
        return $this->type;
    }
    public function setType(ExamType $type): void
    {
        $this->type = $type;
    }

    public function getPatient(): User
    {
        return $this->patient;
    }
    public function setPatient(User $patient): void
    {
        $this->patient = $patient;
    }

    public function getDoctor(): User
    {
        return $this->doctor;
    }
    public function setDoctor(User $doctor): void
    {
        $this->doctor = $doctor;
    }

    public function getTechinitian(): User
    {
        return $this->techinitian;
    }
    public function setTechinitian(User $techinitian): void
    {
        $this->techinitian = $techinitian;
    }

    public function getRealizationDate(): DateTime
    {
        return $this->realizationDate;
    }
    public function setRealizationDate(DateTime $realizationDate): void
    {
        $this->realizationDate = $realizationDate;
    }

    public function getExamImages() : array
    {
        return $this->examImages;
    }
    public function setExamImages($examImages): void
    {
        $this->examImages = $examImages;
    }
    public function addExamImage($examImage) : void{
        array_push($this->examImages, $examImage);
    }

    public function getExamNotes() : array
    {
        return $this->examNotes;
    }
    public function setExamNotes($examNotes): void
    {
        $this->examNotes = $examNotes;
    }
    public function addExamNote($examNote) : void{
        array_push($this->exmamNotes, $examNote);
    }

    public function toJson() : array {
        $map = [];
        if ($this->examId != null) $map['examId'] = $this->examId;
        if ($this->type != null) $map['type'] = ($this->type)->toJson();
        if ($this->patient != null) $map['patient'] = ($this->patient)->toJson();
        if ($this->doctor != null) $map['doctor'] = ($this->doctor)->toJson();
        if ($this->techinitian != null) $map['techinitian'] = ($this->techinitian)->toJson();
        if ($this->realizationDate != null) $map['realizationDate'] = ($this->realizationDate)->getTimestamp();
        if ($this->examImages != null) $map['examImages'] = ExamImage::listToJson($this->examImages);
        if ($this->examNotes != null) $map['examNotes'] = ExamNote::listToJson($this->examNotes);

        return $map;
    }
    public static function listToJson(array $list) : ?array {
        if ($list == null) return null;
        $map = [];
        foreach ($list as $listElement){
            array_push($map, $listElement->toJson());
        }
        return $map;
    }

}
