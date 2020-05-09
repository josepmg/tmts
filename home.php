<?php
    include 'api/objects/user.php';
    include 'api/config/user_dao.php'
?>

<html>
    <head>
        <title>Home page</title>
    </head>
    <body>
        Home page <br>

        <?php
            $userDAO = new UserDAO();
            $result = $userDAO->getUserByLogin('UtAna');
//            date_default_timezone_set('Europe/Lisbon');
//            echo(strval(microtime(true))."<br>".PHP_EOL) ;
//            $var = new DateTime();
//            echo ($var->format('H:i:s') . "<br>");
//            echo( 'DATE: '.date('d/m/Y H:i:s', intval(microtime(true))).PHP_EOL );
        ?>
    </body>
</html>