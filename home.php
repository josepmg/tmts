<?php
    include 'api/config/includes.php';
    date_default_timezone_set('Europe/Lisbon');
?>

<html>
    <head>
        <title>Home page</title>
    </head>
    <body>
        Home page <br>

        <?php
            $userDAO = new UserDAO();
            $result = $userDAO->getByLogin('UtAna');
            $result = (new ExamImageDAO())->getByExam(1);
            foreach ($result as $examImage){
                echo ($examImage);
            }

//            $userDAO->addUser(new User("Jose", 'AdmJose', 'abc123', 'Porto', UserGender::createWithId(2, 'Masc'), new DateTime()
//                , 'abc', UserType::createWithId(1, 'Administrador'), '1'));
        ?>
    </body>
</html>