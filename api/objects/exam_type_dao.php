<?php


class ExamTypeDAO
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
    public function add(string $examType): bool
    {
        $sttm = $this->conn->prepare('INSERT INTO '
            . 'examtype(examType) '
            . 'VALUES (:examType)');
        $sttm->bindValue(':examType', $examType);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }

    /// Read
    public function getByType(string $type): ?ExamType{
        $sttm = $this->conn->prepare('SELECT * FROM examtype WHERE examType = :examType');
        $sttm->bindValue(':examType', $type);

        $sttm->execute();
        $result = $sttm->fetch(PDO::FETCH_ASSOC);

        if (!$result) return null;
        else {
            return ExamType::createWithId(
                intval($result['examTypeId']),
                $result['examType'],
            );
        }
        $sttm = null;
//        $this->closeConection();
    }
    public function getById(int $id): ?ExamType{
        $sttm = $this->conn->prepare('SELECT * FROM examtype WHERE examTypeId = :examTypeId');
        $sttm->bindValue(':examTypeId', $id);

        $sttm->execute();
        $result = $sttm->fetch(PDO::FETCH_ASSOC);

        if (!$result) return null;
        else {
            return ExamType::createWithId(
                intval($result['examTypeId']),
                $result['examType'],
            );
        }
        $sttm = null;
//        $this->closeConection();
    }

    /// Update
    public function update(int $examTypeId, string $examType): bool
    {
        $sttm = $this->conn->prepare('UPDATE examtype SET examType = :examType WHERE examTypeId = :examTypeId');
        $sttm->bindValue(':examTypeId', $examTypeId);
        $sttm->bindValue(':examType', $examType);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }

    /// Delete
    public function delete(int $examTypeId): bool
    {
        $sttm = $this->conn->prepare('DELETE FROM examtype WHERE examTypeId = :examTypeId');
        $sttm->bindValue(':userTypeId', $examTypeId);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }

}