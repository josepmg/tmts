<?php
class ExamNote{
    private int $examNoteId;
    private string $examNote;
    private User $healthProfessional;

    public function __construct(){}
    public static function create(string $examNote, User $healthProfessional){
        $instance = new ExamNote();
        $instance->setExamNote($examNote);
        $instance->setHealthProfessional($healthProfessional);

        return $instance;
    }
    public static function createWithId(int $examNoteId, string $examNote, User $healthProfessional): ExamNote{
        $instance = new ExamNote();
        $instance->setExamNote($examNote);
        $instance->setHealthProfessional($healthProfessional);
        $instance->setExamNoteId($examNoteId);

        return $instance;
    }

    public function getExamNoteId(): int
    {
        return $this->examNoteId;
    }
    public function setExamNoteId(int $examNoteId): void
    {
        $this->examNoteId = $examNoteId;
    }

    public function getExamNote(): string
    {
        return $this->examNote;
    }
    public function setExamNote(string $examNote): void
    {
        $this->examNote = $examNote;
    }

    public function getHealthProfessional(): User
    {
        return $this->healthProfessional;
    }
    public function setHealthProfessional(User $healthProfessional): void
    {
        $this->healthProfessional = $healthProfessional;
    }

    public function toJson() : array {
        $map = [];
        if ($this->examNoteId != null) $map['examNoteId'] = $this->examNoteId;
        if ($this->examNote != null) $map['examNote'] = $this->examNote;
        if ($this->healthProfessional != null) $map['healthProfessional'] = ($this->healthProfessional)->toJson();

        return $map;
    }
    public static function listToJson(array $list) : ?array {
        if ($list == null) return null;
        $map = [];
        foreach ($list as $listElement){
            array_push($map, json_encode($listElement->toJson()));
        }
        return $map;
    }


}
