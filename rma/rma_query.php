<?php
    
    include_once('../info.php');
    session_start();
    header('Location: ./rma.php');

    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }
    extract($_POST);
    
    $year = date("Y");
    $month = date("F");
    $day = date("j");
    $time = date("g:i a");
    $sql = "";        
    
    $hash = $_POST['rev_company'].$day.$year.$time;
    $sql1 = "INSERT INTO rma_num
                (company, walkin, issue_month, issue_day, issue_year, issue_time, hashkey, note)
            VALUES
            ('".$_POST['rev_company']."', '".$_POST['walkin']."',
            '".$month."', '".$day."', '".$year."', '".$time."', '".$hash."', '".$_POST['note']."');";
    
    
    
    foreach( $rev_product as $key => $prod){
        if($prod!=""){
            $sql .= "INSERT INTO rma_item
                        (agent, company, action, 
                        status, product, psn,
                        invoice, qty, problem, 
                        hashkey)
                    VALUES 
                    ('".$_POST['technician']."', '".$_POST['rev_company']."', '".$request_action[$key]."',
                    'RMA issued.', '".$prod."', '".$rev_sn[$key]."',
                    '".$rev_oi[$key]."', '".$rev_qty[$key]."', '".$rev_prob[$key]."', 
                    '".$hash."');";
        }
    }
    
    $sql1.=$sql;
    $end = mysqli_multi_query($mysqli, $sql1);

    exit;
?>