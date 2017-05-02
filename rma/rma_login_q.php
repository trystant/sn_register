<?php
    
    include_once('../info.php');
    session_start();
    header('Location: ./rma.php');

    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }

    extract($_POST);

    $sql = "SELECT id FROM rma_users WHERE id='".$id."' AND passwd='".$passwd."';";

    $result = mysqli_query($mysqli, $sql);
    mysqli_close($mysqli);

    if($result->num_rows != 0){
        $_SESSION['message'] = '';
        $_SESSION['rma_id'] = $id;
        $_SESSION['rma_login_status'] = 'YES';
    } else{
        $_SESSION['message'] = 'Username/password error';
        header('Location: ./rma_login.php');
        exit;
    }


    exit;
?>