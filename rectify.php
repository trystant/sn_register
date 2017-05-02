<?php
    include_once('./info.php');
    session_start();

    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }
    /*
    for($i=4151;$i>=3960;$i--){
        $sql = 'UPDATE orders SET id = id + 1 WHERE id = '.$i.';';
        $result = mysqli_query($mysqli,$sql);
        echo $result;
    }
    */
    mysqli_close();
?>
