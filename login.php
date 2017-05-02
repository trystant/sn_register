<?php
    include_once('./info.php');
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div>
            <a href='./index.php'>Serial Registration</a>
            <a href='./search.php'>Search</a>
        </div>
        <div align='center'>
            <form method='post' action='./login_status.php'>
                User name
                <input type='text' name='login_id' required autofocus/><br>
                Password
                <input type='password' name='login_pw'/><br>
                <input type='submit' name='Submit'/>
            </form>
        </div>
    </body>
</html>
