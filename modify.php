<?php

    include_once('./info.php');
    session_start();
    header('Location: '.$_SESSION['returnAddress']);

    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }

    extract($_POST);
    $modify_model = strtoupper($modify_model);
    $modify_serial = strtoupper($modify_serial);
    $modify_hdd = strtoupper($modify_hdd);
    $modify_hdd_serial = strtoupper($modify_hdd_serial);
    
    $q = "UPDATE dvr, hdd, orders
            SET dvr.dvr_model = '".$modify_model."', 
                dvr.dvr_serial = '".$modify_serial."',
                dvr.invoice = '".$modify_invoice."',
                hdd.hdd = '".$modify_hdd."', 
                hdd.hdd_serial = '".$modify_hdd_serial."',
                hdd.uid = '".$modify_invoice."',
                orders.invoice = '".$modify_invoice."'
            WHERE dvr.id = ".$modify_id." 
            AND hdd.id = ".$modify_id."
            AND orders.id = ".$modify_id.";";

    $log_modify_before = "INSERT INTO serial_log(id, invoice, company, dvr, dvr_serial, hdd, hdd_serial, original_date, modify_date, modify_user, user_ip, modify_type)
                    VALUES('".$modify_id."','".$modify_invoice_before."','".$modify_company."','".$modify_model_before."','".$modify_serial_before."',
                    '".$modify_hdd_before."','".$modify_hdd_serial_before."','".$original_date."','".$modify_date."',
                    '".$_SESSION['login_id']."','".$_SERVER['REMOTE_ADDR']."','Before change');";
    
    $log_modify = "INSERT INTO serial_log(id, invoice, company, dvr, dvr_serial, hdd, hdd_serial, original_date, modify_date, modify_user, user_ip, modify_type)
                    VALUES('".$modify_id."','".$modify_invoice."','".$modify_company."','".$modify_model."','".$modify_serial."',
                    '".$modify_hdd."','".$modify_hdd_serial."','".$original_date."','".$modify_date."',
                    '".$_SESSION['login_id']."','".$_SERVER['REMOTE_ADDR']."','After change');";

    $log_result_before = mysqli_query($mysqli, $log_modify_before);
    $log_result = mysqli_query($mysqli, $log_modify);
    
    $result = mysqli_query($mysqli, $q);
    
    exit;
?>

