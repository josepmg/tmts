<?php


class ExamDAO
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
    public function add($type, $patient, $doctor, $techinitian, $realizationDate, $examImages, $examNotes): bool
    {
        $examNoteDAO = new ExamNoteDAO();
        $examImageDAO = new ExamImageDAO();

        $sttm = $this->conn->prepare('INSERT INTO '
            . 'exam(examType, patient, doctor, technician, realizationDate) '
            . 'VALUES (:examType, :patient, :doctor, :technician, :realizationDate)');
        $sttm->bindValue(':examType', $type);
        $sttm->bindValue(':patient', $patient);
        $sttm->bindValue(':doctor', $doctor);
        $sttm->bindValue(':technician', $techinitian);
        $sttm->bindValue(':realizationDate', $realizationDate);


        $result = $sttm->execute();
        $inserted = $sttm->fetch(PDO::FETCH_ASSOC);
        $sttm = null;

        /// Insert exam images in DB
        foreach ($examImages as $examImage) {
            $examImageDAO->add($examImage, $inserted);
        }

        /// Insert exam notes in DB
        foreach ($examNotes as $examNote) {
            $examNoteDAO->add($examNote['examNote'], $examNote['healthProfessional'], $inserted);
        }

        return $result;
    }

    /// Read
    public function getById(int $id): ?Exam {
        $sttm = $this->conn->prepare('SELECT * FROM exam WHERE examId = :examId');
        $sttm->bindValue(':examId', $id);

        $sttm->execute();
        $result = $sttm->fetch(PDO::FETCH_ASSOC);

        if (!$result) return null;
        else {
            return Exam::createWithId(
                intval($result['examId']),
                (new ExamTypeDAO())->getById(intval($result['examType'])),
                (new UserDAO())->getById(intval($result['patient'])),
                (new UserDAO())->getById(intval($result['doctor'])),
                (new UserDAO())->getById(intval($result['technician'])),
                (new DateTime())->setTimestamp(intval($result['realizationDate'])),
                (new ExamImageDAO())->getByExam($id),
                (new ExamNoteDAO())->getByExam($id),
            );
        }
        $sttm = null;
//        $this->closeConection();
    }
    public function getByPatiet(int $patient): ?array
    {
        $sttm = $this->conn->prepare('SELECT * FROM exam WHERE patient = :patient');
        $sttm->bindValue(':patient ', $patient);

        $sttm->execute();
        $noteList = [];
        if ($sttm->rowCount() > 0) {
            while ($result = $sttm->fetch(PDO::FETCH_ASSOC)) {
                array_push($noteList,
                    Exam::createWithId(
                        intval($result['examId']),
                        (new ExamTypeDAO())->getById(intval($result['examType'])),
                        (new UserDAO())->getById(intval($result['patient'])),
                        (new UserDAO())->getById(intval($result['doctor'])),
                        (new UserDAO())->getById(intval($result['technician'])),
                        (new DateTime())->setTimestamp(intval($result['realizationDate'])),
                        (new ExamImageDAO())->getByExam(intval($result['examId'])),
                        (new ExamNoteDAO())->getByExam(intval($result['examId'])),
                    )
                );
            }
            return $noteList;
        }

        $sttm = null;
//        $this->closeConection();
    }
    public function getByDoctor(int $doctor): ?array
    {
        $sttm = $this->conn->prepare('SELECT * FROM exam WHERE doctor = :doctor');
        $sttm->bindValue(':doctor', $doctor);

        $sttm->execute();
        $noteList = [];
        if ($sttm->rowCount() > 0) {
            while ($result = $sttm->fetch(PDO::FETCH_ASSOC)) {
                array_push($noteList,
                    Exam::createWithId(
                        intval($result['examId']),
                        (new ExamTypeDAO())->getById(intval($result['examType'])),
                        (new UserDAO())->getById(intval($result['patient'])),
                        (new UserDAO())->getById(intval($result['doctor'])),
                        (new UserDAO())->getById(intval($result['technician'])),
                        (new DateTime())->setTimestamp(intval($result['realizationDate'])),
                        (new ExamImageDAO())->getByExam(intval($result['examId'])),
                        (new ExamNoteDAO())->getByExam(intval($result['examId'])),
                    )
                );
            }
            return $noteList;
        }

        $sttm = null;
//        $this->closeConection();
    }
    public function getByTechinician(int $techinician): ?array
    {
        $sttm = $this->conn->prepare('SELECT * FROM exam WHERE technician = :technician');
        $sttm->bindValue(':technician', $techinician);

        $sttm->execute();
        $noteList = [];
        if ($sttm->rowCount() > 0) {
            while ($result = $sttm->fetch(PDO::FETCH_ASSOC)) {
                array_push($noteList,
                    Exam::createWithId(
                        intval($result['examId']),
                        (new ExamTypeDAO())->getById(intval($result['examType'])),
                        (new UserDAO())->getById(intval($result['patient'])),
                        (new UserDAO())->getById(intval($result['doctor'])),
                        (new UserDAO())->getById(intval($result['technician'])),
                        (new DateTime())->setTimestamp(intval($result['realizationDate'])),
                        (new ExamImageDAO())->getByExam(intval($result['examId'])),
                        (new ExamNoteDAO())->getByExam(intval($result['examId'])),
                    )
                );
            }
            return $noteList;
        }

        $sttm = null;
//        $this->closeConection();
    }
    public function getByType(int $type): ?array
    {
        $sttm = $this->conn->prepare('SELECT * FROM exam WHERE examType = :examType');
        $sttm->bindValue(':examType', $type);

        $sttm->execute();
        $noteList = [];
        if ($sttm->rowCount() > 0) {
            while ($result = $sttm->fetch(PDO::FETCH_ASSOC)) {
                array_push($noteList,
                    Exam::createWithId(
                        intval($result['examId']),
                        (new ExamTypeDAO())->getById(intval($result['examType'])),
                        (new UserDAO())->getById(intval($result['patient'])),
                        (new UserDAO())->getById(intval($result['doctor'])),
                        (new UserDAO())->getById(intval($result['technician'])),
                        (new DateTime())->setTimestamp(intval($result['realizationDate'])),
                        (new ExamImageDAO())->getByExam(intval($result['examId'])),
                        (new ExamNoteDAO())->getByExam(intval($result['examId'])),
                    )
                );
            }
            return $noteList;
        }

        $sttm = null;
//        $this->closeConection();
    }
    public function getByRealizationDate(double $realizationDate): ?array
    {
        $sttm = $this->conn->prepare('SELECT * FROM exam WHERE :realizationDate BETWEEN realizationDate AND ($realizationDate + 86400000)');
        $sttm->bindValue(':realizationDate', $realizationDate);

        $sttm->execute();
        $noteList = [];
        if ($sttm->rowCount() > 0) {
            while ($result = $sttm->fetch(PDO::FETCH_ASSOC)) {
                array_push($noteList,
                    Exam::createWithId(
                        intval($result['examId']),
                        (new ExamTypeDAO())->getById(intval($result['examType'])),
                        (new UserDAO())->getById(intval($result['patient'])),
                        (new UserDAO())->getById(intval($result['doctor'])),
                        (new UserDAO())->getById(intval($result['technician'])),
                        (new DateTime())->setTimestamp(intval($result['realizationDate'])),
                        (new ExamImageDAO())->getByExam(intval($result['examId'])),
                        (new ExamNoteDAO())->getByExam(intval($result['examId'])),
                    )
                );
            }
            return $noteList;
        }

        $sttm = null;
//        $this->closeConection();
    }

    /// Update
    public function update(int $examId, int $type, int $patient, int $doctor, int $techinitian, double $realizationDate): bool
    {
        $sttm = $this->conn->prepare('UPDATE user SET examType = :examType, patient = :patient, '
            . 'doctor = :doctor, technician = :technician, realizationDate = :realizationDate '
            . 'WHERE :examId');
        $sttm->bindValue(':examType', $type);
        $sttm->bindValue(':patient', $patient);
        $sttm->bindValue(':doctor', $doctor);
        $sttm->bindValue(':technician', $techinitian);
        $sttm->bindValue(':realizationDate', $realizationDate * 1000);
        $sttm->bindValue(':examId', $examId);

        $result = $sttm->execute();
        $sttm = null;

        return $result;
    }

    /// Delete
    public function delete(int $examId): bool{
        $sttm = $this->conn->prepare('DELETE FROM exam WHERE examId = :examId');
        $sttm->bindValue(':examId', $examId);

        $result = $sttm->execute();
        $sttm = null;

        return $result;

    }

}