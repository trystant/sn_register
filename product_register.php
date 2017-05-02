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
    
    $_SESSION['returnAddress'] = './product_register.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="ss.css"/>
        <title>Swift Product Registration</title>
        <script src="jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("input").focus(function(){
                    $(this).css("background-color", "#cccccc");
                });
                $("input").blur(function(){
                    $(this).css("background-color", "#ffffff");
                });
                $("#list").find("tr:not(:eq(0))").hover(function(){
                    $(this).css("background-color", "#ffef96");
                    },
                    function(){
                        $(this).css("background-color", "#fce5cd");
                });
                $("input:text").keyup(function(){
                    $(this).val( $(this).val().replace(/['"]/g, ''));
                });
            });
        </script>
        <style>
            /*
            input[type="text"]{

                width: 100px;
            }*/
            th {
                background-color: #ffb366;
            }
            table {
                /*table-layout: fixed;*/
            }
            td{
                text-align: center;
                /*border-bottom:1pt solid black;*/
            }
            #list tr{
                background-color:#fce5cd;
            }
        </style>   
        <div align = "center">
            <table style='border-spacing:15px'>
                <tr>
                    <td>
                        <a href="./index.php"><h3>Serial Number Registration</h3></a>
                    </td>
                    <td>
                        <a href="./product_register.php"><h3>Product Register</h3></a>
                    </td>
                    <td>
                        <a href="./search.php"><h3>Search</h3></a>
                    </td>
                    <td>
                        <a href="./hdd_search.php"><h3>HDD Search</h3></a>
                    </td>
                    <td>
                        <a href="./old_search.php"><h3>Old Serial Search</h3></a>
                    </td>
                </tr>
            </table>
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
            <h2>Product Register</h2>
            <form id='reset' method='post' action='./reset.php'></form>
            
            <form name='serialregister' id='form1' method='post' action='./query.php'>
            <input type="submit" form='reset' value="Reset">
                <?php
                    if($_SESSION['inv']!=NULL){
                        echo "<input type='text' name='Company' placeholder='Company name' value='".$_SESSION['comp']."' required/>";
                        echo "<input type='text' name='Invoicenum' placeholder='Invoice' size ='10' value = '".$_SESSION['inv']."' required/>";
                        echo "<input type='text' name='DVR_type' value='".$_SESSION['product_num']."' list='dvrs'/>";
                        echo "<input type='text' name='DVR_Seiral' placeholder='Product Seiral #' autofocus/>";
                    } else{
                        
                        echo "<input type='text' name='Company' placeholder='Company name' required autofocus/>";
                        echo "<input type='text' name='Invoicenum' placeholder='Invoice' size ='10' required/>";
                        echo "<input type='text' name='DVR_type' list='dvrs'/>";
                        echo "<input type='text' name='DVR_Seiral' placeholder='Product Seiral #'/>";
                    }
                ?>
                <input type='submit' name='Submit'/>
                
                <datalist id='dvrs'>
                    <!--NOTHING-->
                    <option value=''>---</option>
                    <!--SDI-->
                        <!--MAGIC PLUS-->
                            <option value='XVST MAGIC-PLS04'>PM04/XMP04</option>
                            <option value='XVST MAGIC-PLS08'>QT08/PM08R/XMP08 </option>
                            <option value='XVST MAGIC-PLS16M'>QT16RP/XMP16</option>
                            <option value='XVST MAGIC-PLS32M'>QT32RP/XMP32</option>
                        <!--UVST-->
                            <option value='XVST NMS-16'>IF16R</option>

                    <!--UVST-->
                        <!--XL/QL-->
                            <option value='UVST MAGIC-QL04'>XLT04</option>
                            <option value='UVST MAGIC-QL08'>XLT08</option>
                            <option value='UVST MAGIC-QL16'>XLT16</option>
                        <!--U SERIES-->
                            <option value='UVST MAGIC-U04'>XPM04</option>
                            <option value='UVST MAGIC-U08'>XPM08</option>
                            <option value='UVST MAGIC-U16'>XPM16</option>

                    <!--TVST-->
                        <!--3R-->
                            <!--PVT-->
                                <option value='TVST PVT04'>TA04A</option>
                                <option value='TVST PVT08'>TA08A</option>
                                <option value='TVST PVT16'>TA16A</option>
                            <!--MAGIC LIGHT-->
                                <option value='TVST MAGIC-TL04'>TALT04/TLT04/TML04</option>
                                <option value='TVST MAGIC-TL08'>TALT08/TLT08/TML08</option>
                                <option value='TVST MAGIC-TL16'>TALT16/TLT16/TML16</option>
                            <!--MAGIC PLUS-->
                                <option value='TVST MAGIC-TP04'>TLT04/TQT04/TMP04</option>
                                <option value='TVST MAGIC-TP08'>TQT08/TPM08/TAPM08/TMP08</option>
                                <option value='TVST MAGIC-TP16'>TQT16/TPM16RP/TAPM16R/TMP16</option>
                                <option value='TVST MAGIC-TP32M'>TAPM32R/TMP32</option>
                            <!--HIKVISION-->
                                <!--STI-->
                                    <option value='TVST STI704'>STI704</option>
                                    <option value='TVST STI708'>STI708</option>
                                    <option value='TVST STI716'>STI716</option>
                                    <option value='TVST STI732'>STI732</option>

                                    <option value='TVST STI804'>STI804</option>
                                    <option value='TVST STI808'>STI808</option>
                                    <option value='TVST STI816'>STI816</option>
                                <!--AR-->
                                    <option value='TVST AR314-4'>AR314-4</option>
                                    <option value='TVST AR314-8'>AR314-8</option>
                                    <option value='TVST AR314-16'>AR314-16</option>

                                    <option value='TVST AR315-4'>AR315-4</option>
                                    <option value='TVST AR315-8'>AR315-8</option>
                                    <option value='TVST AR315-16'>AR315-16</option>
                            <!--TVT-->
                                <option value='TVST TR2904A'>TR2904A</option>
                                <option value='TVST TR2908A'>TR2908A</option>
                                <option value='TVST TR2916A'>TR2916A</option>
                                <option value='TVST TR2732'>TR2732</option>
                    <!--NVST-->
                        <!--3R-->
                            <!--IL-->
                                <option value='NVST Magic-IL04'>IL3204E</option>
                                <option value='NVST Magic-IL08'>IL3208E</option>
                                <option value='NVST Magic-IL16'>IL3216E</option>
                            <!--IP-->
                                <option value='NVST Magic-IP5416'>IP16 16POE</option>
                                <option value='NVST Magic-IP5832'>IP32 NO POE</option>
                                <option value='NVST Magic-IP5832E16'>IP32 16POE</option>
                        <!--HIKVISION-->
                            <!--DH-->
                                <option value='NVST DH6104E1'>DH04</option>
                                <option value='NVST DH6208E1'>DH08</option>
                                <option value='NVST DH6216E2'>DH16</option>
                            <!--DX-->
                                <option value='NVST DX6416E1'>DX16</option>
                                <option value='NVST DX6432E2'>DX32</option>
                        <!--TVT-->
                            <!--TL-->
                                <option value='NVST TL204-04'>TL204</option>
                            <!--TS-->
                                <option value='NVST TS5404-04E'>TS04E</option>
                                <option value='NVST TS5408-08E'>TS08E</option>
                                <option value='NVST TS5432-32E'>TS32E</option>
                            <!--TN-->
                                <option value='NVST TN220-16E'>TN220-16E</option>
                                <option value='NVST TN220-32E'>TN220-32E</option>
                                <option value='NVST TN280-16D'>TN280-16D</option>
                                <option value='NVST TN280-32D'>TN280-32D</option>
                            <!--TX-->
                                <option value='NVST TX204-04L'>TX204-04L</option>
                                <option value='NVST TX204-08L'>TX204-08L</option>
                                <option value='NVST TX208-16'>TX208-16</option>
                                <option value='NVST TX208-16L'>TX208-16L</option>
                                <option value='NVST TX208-32'>TX208-32</option>
                                <option value='NVST TX216-32'>TX216-32</option>



                </datalist>
            </form>

        </div>

        <div align = "center">
            <h3></h3>
            <table id='list'>
                <tr>
                    <th>Company</th>
                    <th>Invoice Number</th>
                    
                    <th>Product</th>
                    <th>Product Serial Number</th>
                    <th>Date</th>
                    <?php
                        if($_SESSION['is_logged']=='YES'){
                            echo "<th>ID</th>"; 
                            echo "<th>Edit</th>";
                        }
                    ?>
                </tr>
        <?PHP
            $sql = "SELECT * FROM (
                        SELECT
                            dvr.invoice,
                            orders.company, orders.id,
                            dvr.dvr_model, dvr.dvr_serial,
                            orders.month, orders.day, orders.year, orders.time
                        FROM dvr
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
                                    /*
                                    echo "<td>";
                                        echo "<input type='text' name='modify_hdd' value='".$row['hdd']."' >";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<input type='text' name='modify_hdd_serial' value='".$row['hdd_serial']."' >";
                                    echo "</td>";
                                    */
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
                            "</td><td>".$row["month"]." ".$row["day"].", ".$row["year"]." ".$row["time"]."</td>";
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

