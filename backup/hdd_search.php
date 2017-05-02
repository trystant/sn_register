<?php
    
    include_once('./info.php');
    session_start();
    

    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }

    $_SESSION['searchBack'] = './hdd_search.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        
    </head>
    <body>
        
        <div align = "center">
            <h3>HDD Serial Search</h3>
            <?php
                echo "<a href='./index.php'>Serial Number Registration</a>";
                echo "<br>";
                echo "<a href='./search.php'>Search</a>";
                echo "<br>";
            ?>    
            <form name='search' id='form_s' method='post' action='./search_query.php'>
                <input type='hidden' name='searchby' value='s_hdd_serial'>
                HDD Serial Number <input type='text' name = 'search_key'autofocus/>
                <input type='submit' name='Submit'/>
            </form>
        </div>
        <br>
        
        <!--TABLE-->
        <div align = "center">
            <table border="1">
                    <tr>
                        <th>Invoice Number</th>
                        <th>Company</th>
                        <th>Product</th>
                        <th>Product Serial Number</th>
                        <th>HDD</th>
                        <th>HDD Serial Number</th>
                        <th>Date</th>
                    <?php
                            if($_SESSION['is_logged']=='YES'){
                                echo "<th>Remove</th>";
                                echo "<th>ID</th>"; 
                            }
                            echo "</tr>";
                        
                            $prev_inv = '';
                            $prev_comp = '';
                            $s_result = mysqli_query($mysqli, $_SESSION['search_result']);
                            if($s_result->num_rows > 0){
                                while($s_row = mysqli_fetch_array($s_result)){
                                    echo "<tr>";
                                    if($s_row["invoice"] == $prev_inv){
                                        echo "<td></td><td></td>";
                                    } else{
                                        $prev_inv = $s_row["invoice"];
                                        $prev_comp = $s_row["company"];
                                        echo "<td>".$s_row["invoice"]."</td><td>".$s_row["company"]."</td>";
                                    }
                                    echo "<td>".$s_row["dvr_model"]."</td><td>".$s_row["dvr_serial"].
                                    "</td><td>".$s_row["hdd"]."</td><td>".$s_row["hdd_serial"]."</td><td>"
                                    .$s_row["month"]." ".$s_row["day"].", ".$s_row["year"]." ".$s_row["time"]."</td>";
                                    
                                    if($_SESSION['is_logged']=='YES'){
                                        echo "<td>
                                                <form method = 'post' action = './remove.php'>
                                                    <button name = 'rmid' type='submit' value = '".$s_row["id"]."'>Remove</button>
                                                </form>
                                            </td>";
                                        echo "<td>".$s_row["id"]."</td>";
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
                                        <td></td>";
                                if($_SESSION['is_logged']=='YES'){
                                    echo "<td></td>
                                        <td></td>";
                                }
                                echo "</tr>";
                            }
                            mysqli_close($mysqli);
                    ?>
            </table>
        </div>
    </body>
</html>
