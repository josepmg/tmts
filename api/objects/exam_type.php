<?php


class ExamType
{
    private int $examTypeId;
    private string $examType;


    public function __construct(string $examType)
    {
        $this->examType = $examType;
    }
    public static function createWithId(int $examTypeId, string $examType): ExamType{
        $instance = new ExamType($examType);
        $instance->examTypeId = $examTypeId;

        return $instance;
    }

    public function getExamTypeId(): int
    {
        return $this->examTypeId;
    }
    public function setExamTypeId(int $examTypeId): void
    {
        $this->examTypeId = $examTypeId;
    }

    public function getExamType(): string
    {
        return $this->examType;
    }
    public function setExamType(string $examType): void
    {
        $this->examType = $examType;
    }



}