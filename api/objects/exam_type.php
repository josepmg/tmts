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
        $instance->setExamTypeId($examTypeId);

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

    public function toJson() : array {
        $map = [];
        if ($this->examTypeId != null) $map['examTypeId'] = $this->examTypeId;
        if ($this->examType != null) $map['examType'] = $this->examType;

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