<?php
    include_once('./info.php');
    session_start();
    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }  
    $_SESSION['returnAddress'] = './search.php';
    $_SESSION['searchBack'] = './search.php';
?>

<!--
    todo
    1. add date search
    2. search period
-->


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="ss.css"/>
        <script type="text/javascript">
            function validate(){
                var dateInput = document.forms["daySearch"]["search_day"].value.split("/");
                var inMonth = parseInt(dateInput[0]);
                if(inMonth<=12 || inMonth>=1){
                    if(parseInt(dateInput[1])<=31 || parseInt(dateInput[1])>=1){
                        if(dateInput[2].length==4){
                            var monthNames = ["January", "February", "March", "April", "May", "June",
                                    "July", "August", "September", "October", "November", "December"];
                            var returnText = monthNames[inMonth-1]+"/"+dateInput[1]+"/"+dateInput[2];
                            document.getElementById('search_text').value = returnText;
                            return true; 
                        }
                    }
                }
                alert("Invalid date");
                return false;
            }
            
            function validateSearch(){
                var search_keyword = document.getElementById('raw_search_key').value;
                if(search_keyword.length > 0 ){
                    return true;
                }
                alert("Search empty!!!");
                return false;
            }
            
            function fillText(m,d,y){
                document.getElementById('search_text').value = m+"/"+d+"/"+y;
                return;
            }
            
        </script>
        <title>Search</title>
        
        <div align = "center">
            <a href="./index.php">Serial Number Registration</a><br>
            <a href="./search.php">Refresh</a>
        </div>
    </head>
    <body>
        <?php
            //echo $_SESSION['error'];
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
        <br>
        <div align = "center">
            <h3>Search</h3>
            
            <a href="./hdd_search.php"><h3>HDD Search</h3></a>

            <form name='search' id='form_s' method='post' onSubmit='validateSearch()' action='./search_query.php'>
                <select name='searchby' autofocus>
                    <option value="s_inv">Invoice</option>
                    <option value="s_comp">Company</option>
                    <option value="s_dvr">dvr</option>
                    <option value="s_dvr_serial">dvr serial</option>
                    <option value="s_hdd">hdd</option>
                    <option value="s_hdd_serial">hdd serial</option>
                </select>
                <input type='text' id='raw_search_key' name = 'search_key'/>
                <input type='submit' name='Submit'/>
            </form>
            
            <form method='post' name='daySearch' onSubmit = 'validate()' action='./search_query.php'>
                Date search(MM/DD/YYYY)
                <input type='text' id='search_text' name='search_day' required/>
                <input type='submit' name='Submit2'/>
            </form>
            <?php
                $todayMonth = date("n");
                $todayDate = date("j");
                $todayYear = date("Y");
                
                if($todayDate=='1'){
                    if($todayMonth=='1'){
                        $yesterdayYear = (int)$todayYear-1;
                        $yesterdayMonth = "12";
                        $yesterdayDate = "31";
                    } else{
                        $yesterdayMonth = (int)$todayMonth-1;
                    }
                } else{
                    $yesterdayDate = (int)$todayDate -1;
                    $yesterdayMonth = $todayMonth;
                    $yesterdayYear = $todayYear;
                }
                echo "<button type='button' onClick='fillText(".$yesterdayMonth.", ".$yesterdayDate.", ".$yesterdayYear.");'>Yesterday</button>";
                echo "<button type='button' onClick='fillText(".$todayMonth.", ".$todayDate.", ".$todayYear.");'>Today</button>";
            ?>
            
        </div>
        <br>
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

                    $s_result = mysqli_query($mysqli, $_SESSION['search_result']);

                    $prev_inv = '';
                    $prev_comp = '';
                    if($s_result->num_rows > 0){
                        while($row = mysqli_fetch_array($s_result)){
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
                                                echo $row["month"]." ".$row["day"].", ".$row["year"]." ".$row["time"];
                                            echo "</td>";
                                            echo "<td>".$row["id"]."</td>";
                                            echo "<input type='hidden' name='modify_id' value='".$row["id"]."'>";
                                            echo "<td>";
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