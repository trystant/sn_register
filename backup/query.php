<?PHP
    header('Location: ./index.php');
    //header('Location: ./result.php');

    include_once('./info.php');
    session_start();
    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }
    
    $invoice = strtoupper($_POST['Invoicenum']);
    $company = strtoupper($_POST['Company']);
    $product = strtoupper($_POST['DVR_type']);
    $product_serial = strtoupper($_POST['DVR_Seiral']);
    $hdd = strtoupper($_POST['HDD_type']);
    $hdd_serial = strtoupper($_POST['HDD_Serial']);
    $serialz = strtoupper($_POST['serialz']);
    
    $_SESSION['inv'] = $invoice;
    $_SESSION['comp'] = $company;

    //if dvr_type != ''
        //if 9char->hik
        //if first 3R, ->magic
        //else tr
    
    if(strlen($product)<3){
        if(substr($product_serial, 0, 2) =='3R'){
            $dvr_pieces = array();
            $dvr_pieces = explode("-", $product_serial);
            $product = $dvr_pieces[1];
        } else if(substr($product_serial, 0, 2) == 'TA'){
            $pvt_pieces = array();
            $pvt_pieces = explode("-", $product_serial);
            //$product = "PVT".substr($pvt_pieces[0], -2);
        } else if(substr($product_serial, 0, 3) == 'AST'){
            $rt_pieces = array();
            $rt_pieces = explode("-", $product_serial);
            //$product = "RT".substr($rt_pieces[0], -2));
        }
    }
    
    $serialz_arr = explode(",", $serialz);
    sort($serialz_arr);
    $_SESSION['arr'] = $serialz;
    $_SESSION['arr_type'] = gettype($serialz);
    $_SESSION['arr2'] = $serialz_arr;
    
    
    $check = "SELECT company, invoice FROM orders WHERE invoice = ".$invoice.";";
    $r = mysqli_query($mysqli,$check);
    $row = mysqli_fetch_array($r);
    
    if($r->num_rows>0 && $company != $row["company"]){
        if($company != $row["company"]){
            $_SESSION['error'] = "<script>alert('Duplicate Invoice number exists!');</script>";
        }
    } else{
        $_SESSION['error'] = "";
        
        //build: insert DVR
        $insert_dvr = "INSERT INTO dvr
        (invoice, dvr_model, dvr_serial)
        VALUES
        ('".$invoice."','".$product."','".$product_serial."');
        ";
        
        //build: insert HDD
        $insert_hdd = "INSERT INTO hdd
        (uid, hdd, hdd_serial)
        VALUES
        ('".$invoice."','".$hdd."','".$hdd_serial."');
        ";
        
        $year = date("Y");
        $month = date("F");
        $day = date("j");
        $time = date("g:i a");

        //build: Insert company invoice
        $insert_company = "INSERT INTO orders
        (invoice, company, year, month, day, time)
        VALUES 
        ('".$invoice."','".$company."','".$year."','".$month."','".$day."','".$time."');
        ";
        
        //DVR HDD Company query
        $q_d = mysqli_query($mysqli, $insert_dvr);
        $q_h = mysqli_query($mysqli, $insert_hdd);
        $q_o = mysqli_query($mysqli, $insert_company);
        
    }
    mysqli_close($mysqli);
    exit;        
?>