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
            $exam = (new ExamDAO())->getById(1);
            $responseJson = json_encode($exam->toJson());
            print_r($responseJson);

        ?>
    </body>
</html>