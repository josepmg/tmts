<?php


class ExamImageDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();;
    }

    public function closeConection(): void
    {
        $this->conn = null;
    }

    /// Create
    public function add(ExamImage $examImage, int $examId)
    {
        $sttm = $this->conn->prepare('INSERT INTO '
            . 'examimage(imgPath, exam) '
            . 'VALUES (:imgPath, :exam)');
        $sttm->bindValue(':imgPath', $examImage->getImgPath());
        $sttm->bindValue(':exam', $examId);

        $sttm->execute();
        $inserted = $sttm->fetchAll();

        $sttm = null;
//        $this->closeConection();
    }

    /// Read
    public function getById(int $id): ?ExamNote{
        $sttm = $this->conn->prepare('SELECT * FROM examnote WHERE examNoteId = :examNoteId');
        $sttm->bindValue(':examNoteId', $id);

        $sttm->execute();
        $result = $sttm->fetch(PDO::FETCH_ASSOC);

        if (!$result) return null;
        else {
            return ExamNote::createWithId(
                intval($result['examNoteId']),
                $result['examNote'],
                (new UserDAO())->getById(intval($result['healthProfessional'])),
            );
        }
        $sttm = null;
//        $this->closeConection();
    }
    public function getByExam(int $exam): ?array
    {
        $sttm = $this->conn->prepare('SELECT * FROM examImageId WHERE exam = :exam');
        $sttm->bindValue(':exam', $exam);

        $sttm->execute();
        $imageList = [];
        if ($sttm->rowCount() > 0) {
            while ($result = $sttm->fetch(PDO::FETCH_ASSOC)) {
                array_push($imageList,
                    ExamImage::createWithId(
                        intval($result['examImageId']),
                        $result['imgPath'],W
                    )
                );
            }

        }

        return $imageList;
        $sttm = null;
//        $this->closeConection();
    }

    /// Update
    public function update(ExamImage $examImage, int $exam)
    {
        $sttm = $this->conn->prepare('UPDATE examimage SET imgPath = :imgPath, exam = :exam, '
            . 'WHERE examImageId = :examImageId');
        $sttm->bindValue(':imgPath', $examImage->getExamImageId());
        $sttm->bindValue(':exam', $exam);
        $sttm->bindValue(':examImageId', $examImage->getExamImageId());

        $sttm->execute();

        $sttm = null;
//        $this->closeConection();
    }

    /// Delete
    public function delete(ExamImage $examImage)
    {
        $sttm = $this->conn->prepare('DELETE FROM examimage WHERE examImageId = :examImageId');
        $sttm->bindValue(':examImageId', $examImage->getExamImageId());

        $sttm->execute();

        $sttm = null;
//        $this->closeConection();
    }
}