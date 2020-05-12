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
    public function add(Exam $exam)
    {
        $examNoteDAO = new ExamNoteDAO();
        $examImageDAO = new ExamImageDAO();

        $sttm = $this->conn->prepare('INSERT INTO '
            . 'exam(examType, patient, doctor, technician, realizationDate) '
            . 'VALUES (:examType, :patient, :doctor, :technician, :realizationDate)');
        $sttm->bindValue(':examType', ($exam->getType())->getExamTypeId());
        $sttm->bindValue(':patient', ($exam->getPatient())->getUserId());
        $sttm->bindValue(':doctor', ($exam->getDoctor())->getUserId());
        $sttm->bindValue(':technician', ($exam->getTechinitian())->getUserId());
        $sttm->bindValue(':realizationDate', ($exam->getRealizationDate())->getTimestamp());


        $sttm->execute();
        $inserted = $sttm->fetch(PDO::FETCH_ASSOC);


        /// Insert exam notes in DB
        foreach ($exam->getExamNotes() as $examNote) {
            $examNoteDAO . add($examNote, $inserted);
        }
        /// Insert exam images in DB
        foreach ($exam->getExamImages() as $examImages) {
            $examImageDAO . add($examImages, $inserted);
        }


        $sttm = null;
//        $this->closeConection();
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
    public function update(Exam $exam)
    {
        $sttm = $this->conn->prepare('UPDATE user SET examType = :examType, patient = :patient, '
            . 'doctor = :doctor, technician = :technician, realizationDate = :realizationDate '
            . 'WHERE :examId');
        $sttm->bindValue(':examType', ($exam->getType())->getExamTypeId());
        $sttm->bindValue(':patient', ($exam->getPatient())->getUserId());
        $sttm->bindValue(':doctor', ($exam->getDoctor())->getUserId());
        $sttm->bindValue(':technician', ($exam->getTechinitian())->getUserId());
        $sttm->bindValue(':realizationDate', ($exam->getRealizationDate())->getTimestamp() * 1000);
        $sttm->bindValue(':examId', $exam->getExamId());

        $sttm->execute();

        $sttm = null;
//        $this->closeConection();
    }

    /// Delete
    public function delete(Exam $exam)
    {
        $sttm = $this->conn->prepare('DELETE FROM exam WHERE examId = :examId');
        $sttm->bindValue(':examId', $exam->getExamId());

        $sttm->execute();

        $sttm = null;

    }

}