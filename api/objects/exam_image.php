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

    public function toJson() : array {
        $map = [];
        if ($this->examImageId != null) $map['examImageId'] = $this->examImageId;
        if ($this->imgPath != null) $map['examImage'] = $this->imgPath;

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