<?php
    include_once('./info.php');
    session_start();
    header('Location: ./invoice_change.php');

    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }

    extract($_POST);

    $find = "SELECT 
                dvr.invoice,
                orders.company, orders.id,
                dvr.dvr_model, dvr.dvr_serial, 
                hdd.hdd, hdd.hdd_serial,
                orders.month, orders.day, orders.year, orders.time, orders.company
            FROM dvr
            INNER JOIN hdd
                ON dvr.invoice = hdd.uid AND dvr.id = hdd.id
            INNER JOIN orders
                ON dvr.invoice = orders.invoice AND dvr.id = orders.id
            WHERE orders.invoice = '".$before."' AND orders.company = '".$company."';";
    
    $result = mysqli_query($mysqli,$find);

    if($result->num_rows>0){
        $update = "UPDATE 
                        dvr, hdd, orders
                   SET 
                        dvr.invoice = '".$after."', 
                        hdd.uid = '".$after."', 
                        orders.invoice = '".$after."'
                   WHERE
                        dvr.invoice = '".$before."' 
                    AND hdd.uid = '".$before."' 
                    AND orders.invoice = '".$before."';";

        $update_result = mysqli_query($mysqli, $update);

    } else{
        $_SESSION['empty'] = 'YES';
    }
    mysqli_close($mysqli);

    exit;
?>