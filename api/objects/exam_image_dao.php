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
    public function add(string $examImagePath, int $examId): bool
    {
        $sttm = $this->conn->prepare('INSERT INTO '
            . 'examimage(imgPath, exam) '
            . 'VALUES (:imgPath, :exam)');
        $sttm->bindValue(':imgPath', $examImagePath);
        $sttm->bindValue(':exam', $examId);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }

    /// Read
    public function getById(int $id): ?ExamImage{
        $sttm = $this->conn->prepare('SELECT * FROM examImage WHERE examImageId = :examImageId');
        $sttm->bindValue(':examImageId', $id);

        $sttm->execute();
        $result = $sttm->fetch(PDO::FETCH_ASSOC);

        if (!$result) return null;
        else {
            return ExamImage::createWithId(
                intval($result['examImageId']),
                $result['imgPath'],
            );
        }
        $sttm = null;
//        $this->closeConection();
    }
    public function getByExam(int $exam): ?array
    {
        $sttm = $this->conn->prepare('SELECT * FROM examImage WHERE exam = :exam');
        $sttm->bindValue(':exam', $exam);

        $sttm->execute();
        $imageList = [];
        if ($sttm->rowCount() > 0) {
            while ($result = $sttm->fetch(PDO::FETCH_ASSOC)) {
                array_push($imageList,
                    ExamImage::createWithId(
                        intval($result['examImageId']),
                        $result['imgPath'],
                    )
                );
            }

        }
        return $imageList;
        $sttm = null;
//        $this->closeConection();
    }

    /// Update
    public function update(int $examImageId, string $examImagePath, int $exam): bool
    {
        $sttm = $this->conn->prepare('UPDATE examimage SET imgPath = :imgPath, exam = :exam, '
            . 'WHERE examImageId = :examImageId');
        $sttm->bindValue(':imgPath', $examImagePath);
        $sttm->bindValue(':exam', $exam);
        $sttm->bindValue(':examImageId', $examImageId);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }

    /// Delete
    public function delete(int $examImageId): bool
    {
        $sttm = $this->conn->prepare('DELETE FROM examimage WHERE examImageId = :examImageId');
        $sttm->bindValue(':examImageId', $examImageId);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }
}