

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>RMA Login</title>
    </head>
    <body>
        <div align='center'>
            <form method='post' action="./rma_login_q.php">
                <h1>RMA Login</h1>
                Username: <input type="text" name = 'id' autofocus required/><br>
                Password: <input type="password" name = 'passwd'><br>
                <input type="submit">
            </form>
        <?php
            session_start();
            echo $_SESSION['message'];
        ?>
        </div>
    </body>    
</html>
