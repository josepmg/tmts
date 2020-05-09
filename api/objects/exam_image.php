<?php
class ExamImage{
    private int $examImageId;
    private string $imgPath;

    /**
     * ExamImage constructor.
     * @param int $examImageId
     * @param string $imgPath
     */
    public function __construct(int $examImageId, string $imgPath)
    {
        $this->examImageId = $examImageId;
        $this->imgPath = $imgPath;
    }

    /**
     * @return int
     */
    public function getExamImageId(): int
    {
        return $this->examImageId;
    }

    /**
     * @param int $examImageId
     */
    public function setExamImageId(int $examImageId): void
    {
        $this->examImageId = $examImageId;
    }

    /**
     * @return string
     */
    public function getImgPath(): string
    {
        return $this->imgPath;
    }

    /**
     * @param string $imgPath
     */
    public function setImgPath(string $imgPath): void
    {
        $this->imgPath = $imgPath;
    }



}