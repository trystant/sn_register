<?php

    //to do lists
    //1. implement auto-fill for dvr models (3R)
    //2. find a way to add multiple HDDs for DVR
    //3. search periods
    

    include_once('./info.php');
    session_start();

    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }
    
    $_SESSION['returnAddress'] = './index.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="ss.css"/>
        <title>Seiral Number Tracker</title>
        <script type="text/javascript">

        </script>
        <div align = "center">
            <a href="./search.php">Search</a><br>
            <a href="./index.php">Refresh</a>
        </div>
    </head>
    <body>
        <?php
            echo $_SESSION['error'];
            $_SESSION['error'] = "";
            if($_SESSION['is_logged']=='YES'){
                echo "<div>";
                echo "Hello, ".$_SESSION['login_id']."<br>";
                echo "<a href='./logout.php'>Logout</a><br>";
                echo "<a href='./log.php'>Serial Log</a>";
                echo "</div>";
            } else{
                echo "<a href='./login.php'>Login</a>";
            }
        ?>
        <div align = "center">
            <h3>Serial Number Registration</h3>
            <form name='serialregister' id='form1' method='post' action='./query.php'>
                <?php
                    if($_SESSION['inv']!=NULL){
                        
                        echo "<input type='text' name='Company' placeholder='Company name' value='".$_SESSION['comp']."' required/>";
                        echo "<input type='text' name='Invoicenum' placeholder='Invoice' size ='10' value = '".$_SESSION['inv']."'required/>";
                    } else{
                        
                        echo "<input type='text' name='Company' placeholder='Company name' required/>";
                        echo "<input type='text' name='Invoicenum' placeholder='Invoice' size ='10' required/>";
                    }
                ?>

                <input type='text' name='DVR_type' placeholder='Product type' value='' />
                <input type='text' name='DVR_Seiral' placeholder='Product Seiral #'/>
                <input type='text' name='HDD_type' placeholder='HDD Type' autofocus/>
                <input type='text' name='HDD_Serial' placeholder='HDD Serial #'/>
                <input type='submit' name='Submit'/>
            </form>

        </div>

        <div align = "center">
            <h3></h3>
            <table border="1">
                <tr>
                    <th>Company</th>
                    <th>Invoice Number</th>
                    
                    <th>Product</th>
                    <th>Product Serial Number</th>
                    <th>HDD</th>
                    <th>HDD Serial Number</th>
                    <th>Date</th>
                    <?php
                        if($_SESSION['is_logged']=='YES'){
                            echo "<th>ID</th>"; 
                            echo "<th>Edit</th>";
                            /*
                            if($_POST['hidden_edit']=='YES'){
                                echo "<th>Edit</th>";
                            } else{
                                echo "<th>Edit</th>";
                            }*/
                        }
                    ?>
                </tr>
        <?PHP
            $sql = "SELECT * FROM (
                        SELECT
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
                        ORDER BY id DESC
                        LIMIT 20
                        ) dvr
                        
                    ORDER BY id ASC;
                    ";

            $result = mysqli_query($mysqli, $sql);

            $prev_inv = '';
            $prev_comp = '';
            if($result->num_rows > 0){
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    //Logged in users will be able to view the ID number
                    //as well as ability to delete the entry.
                        if($_POST['hidden_edit_modify']=='YES' && $row['id']==$_POST['hidden_edit_row']){
                        //If the invoice number is same, it will skip the invoice&company duplicate
                            //echo "<tr>";
                                //Modify row
                                echo "<form action='./modify.php' method='post'>";
                                    echo "<td>";
                                        //echo "<input type='text' name='Company' value='".$row['company']."' required/>";
                                        echo $row['company'];
                                        echo "<input type='hidden' name='modify_company' value='".$row['company']."'>";
                                    echo "</td>";
                                    echo "<td>";
                                        //echo "<input type='text' name='Company' value='".$row['invoice']."' required/>";
                                        echo $row['invoice'];
                                        echo "<input type='hidden' name='modify_invoice' value='".$row['invoice']."'>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<input type='text' name='modify_model' value='".$row['dvr_model']."'>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<input type='text' name='modify_serial' value='".$row['dvr_serial']."'>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<input type='text' name='modify_hdd' value='".$row['hdd']."' >";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<input type='text' name='modify_hdd_serial' value='".$row['hdd_serial']."' >";
                                    echo "</td>";
                                    echo "<td>";
                                    $original_date = $row["month"]." ".$row["day"].", ".$row["year"]." ".$row["time"];
                                        echo $original_date;
                                    echo "</td>";
                                    echo "<td>".$row["id"]."</td>";
                                    echo "<input type='hidden' name='modify_id' value='".$row["id"]."'>";
                                    echo "<td>";
                                    echo "<input type='hidden' name='original_date' value='".$original_date."'>";
                                    $modify_date = date("F")." ".date("j").", ".date("Y")." ".date("g:i a");
                                    echo "<input type='hidden' name='modify_date' value='".$modify_date."'>";
                                    //Modify row button
                                    echo "<input type='submit' name='modify_submit' value='change'>";                                        
                                echo "</form>";
                                //Cancel button
                                echo "<form action='' method='post'>";
                                        echo "<input type='hidden' name='hidden_edit_modify' value='NO'>";
                                        echo "<input type='hidden' name='hidden_edit' value='YES'>";
                                        echo "<input type='submit' name='hidden_submit_modify' value='Cancel'>";
                                echo "</form>";
                                    echo "</td>";
                            
                        } else{
                            //****Displays rows****
                            if($row["invoice"] == $prev_inv){
                                echo "<td></td><td></td>";
                            } else{
                                $prev_inv = $row["invoice"];
                                $prev_comp = $row["company"];
                                echo "<td>".$row["company"]."</td>";
                                echo "<td>".$row["invoice"]."</td>";    
                            }
                            echo "<td>".$row["dvr_model"]."</td><td>".$row["dvr_serial"].
                            "</td><td>".$row["hdd"]."</td><td>".$row["hdd_serial"]."</td><td>"
                            .$row["month"]." ".$row["day"].", ".$row["year"]." ".$row["time"]."</td>";
                            //***Display rows ends**

                            if($_SESSION['is_logged']=='YES'){
                                echo "<td>".$row["id"]."</td>";

                                if($_POST['hidden_edit']=='YES' && $row['id']==$_POST['hidden_edit_row']){
                                    //REMOVE BUTTON
                                    echo "<td>
                                            <form method='post' action='./remove.php'>
                                                <button name = 'rmid' type='submit' value = '".$row["id"]."'>Remove</button>
                                            </form>";
                                        //MODIFY BUTTON
                                        echo "<form action='' method='post'>";
                                                echo "<input type='hidden' name='hidden_edit_modify' value='YES'>";
                                                echo "<input type='hidden' name='hidden_edit' value='YES'>";
                                                echo "<input type='hidden' name='hidden_edit_row' value='".$row["id"]."'>";
                                                echo "<input type='submit' name='hidden_submit_modify' value='Modify'>";
                                        echo "</form>";
                                        //BACK BUTTON
                                        echo "<form action='' method='post'>";
                                                echo "<input type='hidden' name='hidden_edit' value='NO'>";
                                                echo "<input type='submit' name='hidden_submit_back' value='Cancel'>";
                                        echo "</form>";
                                    echo "</td>";
                                                            
                                } else{
                                    echo "<td>";
                                        //EDIT BUTTON
                                        echo "<form action='' method='post'>";
                                            echo "<input type='hidden' name='hidden_edit' value='YES'>";
                                            echo "<input type='hidden' name='hidden_edit_row' value='".$row["id"]."'>";
                                            echo "<input type='submit' name='hidden_submit' value='EDIT'>";
                                        echo "</form>";
                                    echo "</td>";
                                }
                            }
                        }
                        echo "</tr>";
                    }
            } else{
                echo "<tr>
                        <td>Empty<td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>";
            }
            mysqli_close($mysqli);
        ?>
            </table>
        </div>
    </body>

</html>

