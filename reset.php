<?php
    session_start();
    header('Location: ./'.$_SESSION['returnAddress']);
    echo $_SESSION['returnAddress'];
    $_SESSION['comp']='';
    $_SESSION['inv']='';
    exit;
?>