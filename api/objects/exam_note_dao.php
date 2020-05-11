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
    public function add(ExamNote $examNote, int $examId)
    {
        $sttm = $this->conn->prepare('INSERT INTO '
            . 'examnote(examNote, exam, healthProfessional) '
            . 'VALUES (:examNote, :exam, :healthProfessional )');
        $sttm->bindValue(':examNote', $examNote->getExamNote());
        $sttm->bindValue(':exam', $examId);
        $sttm->bindValue(':healthProfessional', ($examNote->getHealthProfessional())->get_userId());

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
        $sttm = $this->conn->prepare('SELECT * FROM examtype WHERE exam = :exam');
        $sttm->bindValue(':exam', $exam);

        $sttm->execute();
        $noteList = [];
        if ($sttm->rowCount() > 0) {
            while ($result = $sttm->fetch(PDO::FETCH_ASSOC)) {
                array_push($noteList,
                    ExamNote::createWithId(
                        intval($result['examNoteId']),
                        $result['examNote'], (new UserDAO())->getById(intval($result['healthProfessional']))
                    )
                );
            }
            return $noteList;
        }

        $sttm = null;
//        $this->closeConection();
    }
    public function getByHealthProfessional(int $healthProfeesional): ?array
    {
        $sttm = $this->conn->prepare('SELECT * FROM examtype WHERE healthProfeesional = :healthProfeesional');
        $sttm->bindValue(':healthProfeesional', $healthProfeesional);

        $sttm->execute();
        $noteList = [];
        if ($sttm->rowCount() > 0) {
            while ($result = $sttm->fetch(PDO::FETCH_ASSOC)) {
                array_push($noteList,
                    ExamNote::createWithId(
                        intval($result['examNoteId']),
                        $result['examNote'], (new UserDAO())->getById(intval($result['healthProfessional']))
                    )
                );
            }
            return $noteList;
        }

        $sttm = null;
//        $this->closeConection();
    }

    /// Update
    public function update(ExamNote $examNote, int $exam)
    {
        $sttm = $this->conn->prepare('UPDATE examnote SET examNote = :examNote, exam = :exam, '
            . 'healthProfessional = :healthProfessional WHERE examNoteId = :examNoteId');
        $sttm->bindValue(':examNoteId', $examNote->getExamNoteId());
        $sttm->bindValue(':examNote', $examNote->getExamNote());
        $sttm->bindValue(':exam', $exam);
        $sttm->bindValue(':healthProfessional', $examNote->getHealthProfessional());

        $sttm->execute();

        $sttm = null;
//        $this->closeConection();
    }

    /// Delete
    public function delete(ExamNote $examNote)
    {
        $sttm = $this->conn->prepare('DELETE FROM examnote WHERE examNoteId = :examNoteId');
        $sttm->bindValue(':examNoteId', $examNote->getExamNoteId());

        $sttm->execute();

        $sttm = null;
//        $this->closeConection();
    }

}