<?php
    include_once('./info.php');
    session_start();
    header('Location: '.$_SESSION['searchBack']);
    
    $option = $_POST['searchby'];
    $key = strtoupper($_POST['search_key']);
    $s_date = array();
    $s_date = explode("/", $_POST['search_day']);
    
    $sql = "SELECT 
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
            WHERE 
                dvr.invoice LIKE '%".strtoupper($key)."%'
                OR
                orders.company LIKE '%".strtoupper($key)."%'
                OR
                dvr.dvr_model LIKE '%".strtoupper($key)."%'
                OR
                dvr.dvr_serial LIKE '%".strtoupper($key)."%'
                OR
                hdd.hdd LIKE '%".strtoupper($key)."%'
                OR
                hdd.hdd_serial LIKE '%".strtoupper($key)."%'
                
            ORDER BY id ASC;";
               
    $_SESSION['search_result'] = $sql;
  /*
  OR
                    (orders.month = '".$s_date[0]."' 
                    AND 
                    orders.day = '".$s_date[1]."' 
                    AND 
                    orders.year = '".$s_date[2]."')  
                    */
    exit;
?>
