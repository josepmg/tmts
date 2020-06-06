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
            $user = ( new UserDAO())->getById(1);
            $responseJson = json_encode($user->toJson());
            print_r($responseJson);

        ?>
    </body>
</html>