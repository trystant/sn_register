<?php
    include_once('./info.php');
    session_start();

    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">        
    </head>
    <body>
        <?php
            echo $_SESSION['arr'];
            echo "<br>";
            echo $_SESSION['arr2'];
            echo "<br>";
            echo $_SESSION['arr_type'];
            //echo $_SESSION['inv'];
            //echo $_SESSION['comp'];
        ?>
    </body>
</html>