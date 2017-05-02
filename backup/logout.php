<?php
    session_start();
    header('Location: '.$_SESSION['returnAddress']);
    session_unset($_SESSION['login_id']);
    session_unset($_SESSION['is_logged']);
    session_destroy();
    exit;
?>