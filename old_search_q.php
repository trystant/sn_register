<?php
    session_start();
    header('Location: '.$_SESSION['old_return']);

    extract($_POST);

    $sql = "SELECT date, company, invoice, unit, hdd, hdd_s, unit_s, id
            FROM old_hdd
            WHERE
                invoice LIKE '%".$key."%'
                OR
                company LIKE '%".$key."%'
                OR
                unit LIKE '%".$key."%'
                OR
                unit_s LIKE '%".$key."%'
                OR
                hdd LIKE '%".$key."%'
                OR
                hdd_s LIKE '%".$key."%'
                OR
                date LIKE '%".$key."%'
            ORDER BY id ASC;
             ";

    $_SESSION['old_search_result'] = $sql;

    
    exit;
?>