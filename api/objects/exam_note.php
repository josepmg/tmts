<?php
class ExamNote{
    private int $examNoteId;
    private string $examNote;
    private User $healthProfessional;

    public function __construct(string $examNote, User $healthProfessional)
    {
        $this->examNote = $examNote;
        $this->healthProfessional = $healthProfessional;
    }
    public static function createWithId(int $examNoteId, string $examNote, User $healthProfessional): ExamNote{
        $instance = new ExamNote($examNote, $healthProfessional);
        $instance->examNoteId = $examNoteId;

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


}
