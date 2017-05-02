<?PHP
    include_once('./info.php');
    session_start();

    header('Location: ./'.$_SESSION['returnAddress']);
    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }
    
    $year = date("Y");
    $month = date("F");
    $day = date("j");
    $time = date("g:i a");


    $invoice = strtoupper($_POST['Invoicenum']);
    $company = strtoupper($_POST['Company']);
    $product = strtoupper($_POST['DVR_type']);
    $product_serial = strtoupper($_POST['DVR_Seiral']);
    $hdd = strtoupper($_POST['HDD_type']);
    $hdd_serial = strtoupper($_POST['HDD_Serial']);
    $serialz = strtoupper($_POST['serialz']);
    
    $_SESSION['inv'] = $invoice;
    $_SESSION['comp'] = $company;
    $_SESSION['product_num'] = $product;
   
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
	/*
         $new_q = "INSERT INTO dvr
        (invoice, dvr_model, dvr_serial)
        VALUES
        ('".$invoice."','".$product."','".$product_serial."');
        ";
	*/
         $insert_dvr = "INSERT INTO dvr
        (invoice, dvr_model, dvr_serial)
        VALUES
        ('".$invoice."','".$product."','".$product_serial."');
        ";


       
        //build: insert HDD
	/*
        $new_q .= "INSERT INTO hdd
        (uid, hdd, hdd_serial)
        VALUES
        ('".$invoice."','".$hdd."','".$hdd_serial."');
        ";
	*/
        $insert_hdd = "INSERT INTO hdd
        (uid, hdd, hdd_serial)
        VALUES
        ('".$invoice."','".$hdd."','".$hdd_serial."');
        ";

	 //build: Insert company invoice
        $insert_company= "INSERT INTO orders
        (invoice, company, year, month, day, time)
        VALUES 
        ('".$invoice."','".$company."','".$year."','".$month."','".$day."','".$time."');
        ";
        //$new_q_r = mysqli_multi_query($mysqli, $new_q);
        //DVR HDD Company query
	
        $q_d = mysqli_query($mysqli, $insert_dvr);
        $q_h = mysqli_query($mysqli, $insert_hdd);
        $q_o = mysqli_query($mysqli, $insert_company);
        
    }
    mysqli_close($mysqli);
    exit;        
?>
