<?php
    include 'api/objects/user.php';
?>

<html>
    <head>
        <title>Home page</title>
    </head>
    <body>
        Home page
        <?php
            $user = new User(1, "José", "jpgomes", "123", "Aqui", "MAS", 123, "1234", "ADM");
            for ($i = 0; $i < 10; $i++) {
                echo "<br>" . $user->get_name();
            }
        ?>
    </body>
</html>