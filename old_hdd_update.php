<?php

    include_once('./info.php');
    session_start();

    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], 'serialNumber');

    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }
    
    
    $sql = "SELECT *
            FROM old_hdd
            ;";
    
    $result = mysqli_query($mysqli, $sql);

    if($result->num_rows>0){
        while($row=mysqli_fetch_array($result)){

            //date YES
            if(strlen($row['date'])!=0){
                $curr_date = $row['date'];
                $setDate = "date = '".$curr_date."'";
                
                //company YES
                if(strlen($row['company'])!=0){
                    $curr_company = $row['company'];
                    $setCompany = " company = '".$curr_company."'";
                    $sql_update = '';

                } else{
                    //date YES
                    //company NO
                    $sql_update = "UPDATE old_hdd SET ".$setCompany." 
                                WHERE id = '".$row['id']."';";
                    //echo $row['id']." update complete!";
                }
            } else{
                //date NO
                if(strlen($row['company'])!=0){
                    //company YES
                    $curr_company = $row['company'];
                    $setCompany = " company = '".$curr_company."'";

                    $sql_update = "UPDATE old_hdd SET ".$setDate." 
                                WHERE id = '".$row['id']."';";
                } else{
                    $sql_update = "UPDATE old_hdd SET ".$setDate.", ".$setCompany." 
                                WHERE id = '".$row['id']."';";
                }
            }

            $sql_update_result = mysqli_query($mysqli, $sql_update);
        }
    }
    echo "done";
            
?>




<?php
/*
            if(strlen($row['date'])!=0){
                $curr_date = $row['date'];
                $setDate = "date = '".$curr_date."'";



            } else{
                if(strlen($row['company'])!=0){
                    $curr_company = $row['company'];
                    $setCompany = " company = '".$curr_company."'";
                    $sql_update1 = "UPDATE old_hdd SET ".$setDate." 
                                WHERE id = '".$row['id']."';";
                    $sql_update_result1 = mysqli_query($mysqli, $sql_update1);
                } else{
                    $sql_update2 = "UPDATE old_hdd SET ";
                    $sql_update2 .= $setDate;
                    $sql_update2 .= $setCompany;
                    $sql_update2 .= " WHERE id = '";
                    $sql_update2 .= $row['id']."';";
                    
                    $sql_update_result2 = mysqli_query($mysqli, $sql_update2);
                }              
            }
            */
?>