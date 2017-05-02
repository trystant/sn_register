<?php
    include_once('./info.php');
    session_start();
    header('Location: '.$_SESSION['searchBack']);
    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }
    
    $option = $_POST['searchby'];
    $key = $_POST['search_key'];
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
            WHERE ";
    
    switch($_POST['searchby']){
        case 's_inv':
            $sql.="dvr.invoice LIKE '%".$key."%' ";
            break;
        case 's_comp':
            $sql.="orders.company LIKE '%".$key."%' ";
            break;
        case 's_dvr':
            $sql.="dvr.dvr_model LIKE '%".$key."%' ";
            break;
        case 's_dvr_serial':
            $sql.="dvr.dvr_serial LIKE '%".$key."%' ";
            break;
        case 's_hdd':
            $sql.="hdd.hdd LIKE '%".$key."%' ";
            break;
        case 's_hdd_serial':
            $sql.="hdd.hdd_serial LIKE '%".$key."%' ";
            break;
        default:
            $sql.="orders.month = '".$s_date[0]."' AND orders.day = '".$s_date[1]."' AND orders.year = '".$s_date[2]."' ";
        /*
        case 's_date':
            $sql+="orders.month, orders.day '".$key."' ";
            break;
            */
    }
    
    if(strlen($sql)>10){
        $sql.="
                ORDER BY invoice ASC;";
    }
    
    $result = mysqli_query($mysqli, $sql);
    $vec = array();
    while($row = mysqli_fetch_array($result)){
        array_push($vec,$row['invoice']);
    }
    $sql2 = "";
    $v_size = sizeof($vec);
    if($v_size>0){
        $sql2 = "SELECT 
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
            WHERE (dvr.invoice = '".$vec[0]."') ";
      
        if($v_size>1){
            for($i=1;$i<$v_size;$i++){
                $sql2.=" OR (dvr.invoice = '".$vec[$i]."') ";
            }
        }
        $sql2.= "
                ORDER BY id ASC;";
    }
    $_SESSION['search_result'] = $sql2;
    mysqli_close($mysqli);
    exit;
?>