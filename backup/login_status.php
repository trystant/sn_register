<?php
    include_once('./info.php');
    session_start();
    //header('Location: '.$_SESSION['returnAddress']);
    //header('Refresh: 3; URL=./login.php');
    
    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }  

    extract($_POST);
    //$encrypted_pass = sha1($login_pw);
    
    $q = "SELECT id, username, password FROM users WHERE username='".$login_id."' AND password='".$login_pw."';";
    $result = mysqli_query($mysqli, $q);
    
    if($result->num_rows == 1){
        $_SESSION['is_logged'] = 'YES';
        $_SESSION['login_id'] = $login_id;
        //echo "<script>alert('Invalid user and/or password.');</script>";
        header('Location: '.$_SESSION['returnAddress']);
        exit;
    } else{
        echo "<script>alert('Invalid user and/or password.');</script>";
        header('Location: ./login.php');
        exit;
    }
    mysqli_close($mysqli);
?>
        