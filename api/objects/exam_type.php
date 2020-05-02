<?php


class ExamType
{
    private int $examTypeId;
    private string $examType;


    public function __construct(int $examTypeId, string $examType)
    {
        $this->examTypeId = $examTypeId;
        $this->examType = $examType;
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