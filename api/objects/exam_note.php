<?php
class ExamNote{
    private int $examNoteId;
    private string $examNote;
    private User $healthProfessional;

    /**
     * ExamNote constructor.
     * @param int $examNoteId
     * @param string $examNote
     * @param User $healthProfessional
     */
    public function __construct(int $examNoteId, string $examNote, User $healthProfessional)
    {
        $this->examNoteId = $examNoteId;
        $this->examNote = $examNote;
        $this->healthProfessional = $healthProfessional;
    }

    /**
     * @return int
     */
    public function getExamNoteId(): int
    {
        return $this->examNoteId;
    }

    /**
     * @param int $examNoteId
     */
    public function setExamNoteId(int $examNoteId): void
    {
        $this->examNoteId = $examNoteId;
    }

    /**
     * @return string
     */
    public function getExamNote(): string
    {
        return $this->examNote;
    }

    /**
     * @param string $examNote
     */
    public function setExamNote(string $examNote): void
    {
        $this->examNote = $examNote;
    }

    /**
     * @return User
     */
    public function getHealthProfessional(): User
    {
        return $this->healthProfessional;
    }

    /**
     * @param User $healthProfessional
     */
    public function setHealthProfessional(User $healthProfessional): void
    {
        $this->healthProfessional = $healthProfessional;
    }


}
