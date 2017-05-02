<?php
    
    
    include_once('./info.php');
    session_start();
    
    header('Location: '.$_SESSION['returnAddress']);
    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }

    $rmid = $_POST["rmid"];
    
    $rm_sql = "DELETE dvr, hdd, orders
                FROM dvr
                INNER JOIN hdd
                    ON dvr.id = hdd.id
                INNER JOIN orders
                    ON dvr.id = orders.id
                WHERE dvr.id = ".$rmid.";
              ";
    
    $rm_query = "SELECT 
                dvr.invoice,
                orders.company, orders.id,
                dvr.dvr_model, dvr.dvr_serial, 
                hdd.hdd, hdd.hdd_serial,
                orders.month, orders.day, orders.year, orders.time
            FROM dvr
            INNER JOIN hdd
                ON dvr.invoice = hdd.uid AND dvr.id = hdd.id
            INNER JOIN orders
                ON dvr.invoice = orders.invoice AND dvr.id = orders.id
            WHERE orders.id = '".$rmid."';";
    

    $rm_items = mysqli_query($mysqli, $rm_query);

    $row = mysqli_fetch_array($rm_items);
    $original_date = $row["month"]." ".$row["day"].", ".$row["year"]." ".$row["time"];
    $modify_date = date("F")." ".date("j").", ".date("Y")." ".date("g:i a");
    $backup = "INSERT INTO serial_log(id, invoice, company, dvr, dvr_serial, hdd, hdd_serial, original_date, modify_date, modify_user, user_ip, modify_type)
                VALUES ('".$row['id']."', '".$row['invoice']."', '".$row['company']."', '".$row['dvr_model']."', '".$row['dvr_serial']."', '".$row['hdd']."', '".$row['hdd_serial']."'
                , '".$original_date."', '".$modify_date."', '".$_SESSION['login_id']."','".$_SERVER['REMOTE_ADDR']."','remove');";
    
    $backup_status = mysqli_query($mysqli, $backup);
    $rm_status = mysqli_query($mysqli, $rm_sql);
    
    
    
    mysqli_close($mysqli);
    


    $_SESSION['inv'] = NULL;
    $_SESSION['comp'] = NULL;
    
    exit;
?>