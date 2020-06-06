<?php

class ExamNoteDAO
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
    public function add(string $examNote, int $healthProfessional, int $examId): bool
    {
        $sttm = $this->conn->prepare('INSERT INTO '
            . 'examnote(examNote, exam, healthProfessional) '
            . 'VALUES (:examNote, :exam, :healthProfessional )');
        $sttm->bindValue(':examNote', $examNote);
        $sttm->bindValue(':exam', $examId);
        $sttm->bindValue(':healthProfessional', $healthProfessional);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
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
        $sttm = $this->conn->prepare('SELECT * FROM examNote WHERE exam = :exam');
        $sttm->bindValue(':exam', $exam);

        $sttm->execute();
        $noteList = [];
        if ($sttm->rowCount() > 0) {
            while ($result = $sttm->fetch(PDO::FETCH_ASSOC)) {
                array_push($noteList,
                    ExamNote::createWithId(
                        intval($result['examNoteId']),
                        $result['examNote'],
                        (new UserDAO())->getById(intval($result['healthProfessional']))
                    )
                );
            }
        }
        return $noteList;
        $sttm = null;
//        $this->closeConection();
    }
    public function getByHealthProfessional(int $healthProfeesional): ?array
    {
        $sttm = $this->conn->prepare('SELECT * FROM examNote WHERE healthProfessional = :healthProfessional');
        $sttm->bindValue(':healthProfessional', $healthProfeesional);

        $sttm->execute();
        $noteList = [];
        if ($sttm->rowCount() > 0) {
            while ($result = $sttm->fetch(PDO::FETCH_ASSOC)) {
                array_push($noteList,
                    ExamNote::createWithId(
                        intval($result['examNoteId']),
                        $result['examNote'],
                        (new UserDAO())->getById(intval($result['healthProfessional']))
                    )
                );
            }
            return $noteList;
        }

        $sttm = null;
//        $this->closeConection();
    }

    /// Update
    public function update(int $examNoteId, string $examNote, int $healthProfessional, int $examId): bool
    {
        $sttm = $this->conn->prepare('UPDATE examnote SET examNote = :examNote, exam = :exam, '
            . 'healthProfessional = :healthProfessional WHERE examNoteId = :examNoteId');
        $sttm->bindValue(':examNoteId', $examNoteId);
        $sttm->bindValue(':examNote', $examNote);
        $sttm->bindValue(':exam', $examId);
        $sttm->bindValue(':healthProfessional', $healthProfessional);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }

    /// Delete
    public function delete(int $examNoteId): bool
    {
        $sttm = $this->conn->prepare('DELETE FROM examnote WHERE examNoteId = :examNoteId');
        $sttm->bindValue(':examNoteId', $examNoteId);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }

}