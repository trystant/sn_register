<?php
    
    include_once('../info.php');
    session_start();
    header('Location: ./b.php');

    
    extract($_POST);

    $sql = "UPDATE rma_item
            SET rma_item.status='".$status."', rma_item.action='".$action."', 
            rma_item.product='".$product."', rma_item.psn='".$psn."',
            rma_item.invoice='".$invoice."', rma_item.qty='".$qty."', 
            rma_item.problem='".$problem."', rma_item.solution='".$solution."'
            WHERE rma_item.uid = '".$uid."';";

    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }
    $result = mysqli_query($mysqli, $sql);
    /*
    echo $sql;
    echo "<br>";
    echo $result;
    */
    exit;
?>