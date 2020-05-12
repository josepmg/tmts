<?php
class ExamImage{
    private int $examImageId;
    private string $imgPath;

    public function __construct(string $imgPath)
    {
        $this->imgPath = $imgPath;
    }
    public static function createWithId(int $examImageId, string $imgPath) : ExamImage{
        $instance = new ExamImage($imgPath);
        $instance->setExamImageId($examImageId);

        return $instance;
    }

    public function getExamImageId(): int
    {
        return $this->examImageId;
    }
    public function setExamImageId(int $examImageId): void
    {
        $this->examImageId = $examImageId;
    }

    public function getImgPath(): string
    {
        return $this->imgPath;
    }
    public function setImgPath(string $imgPath): void
    {
        $this->imgPath = $imgPath;
    }



}