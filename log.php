<?php
    include_once('./info.php');
    session_start();
    
    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }
    $_SESSION['returnAddress'] = './log.php';
?>

<html>
    <head>
        <div align = "center">
            <table style='border-spacing:15px'>
                <tr>
                    <td>
                        <a href="./search.php"><h3>Search</h3></a>
                    </td>
                    <td>
                        <a href="./index.php"><h3>Registration</h3></a>
                    </td>
                </tr>
            </table>
        </div>
    </head>
    <body>
        <?php
            if($_SESSION['is_logged']=='YES'){
                echo "<div>";
                echo "Hello, ".$_SESSION['login_id']."<br>";
                echo "<a href='./logout.php'>Logout</a>";
                echo "</div>";
            } else{
                echo "<a href='./login.php'>Login</a>";
            }
        ?>
        <div align = "center">
            <h3>Serial Number Modification Log</h3>
            <table border="1">
                <tr>
                    <th>Log ID</th>
                    <th>Registered ID</th>
                    <th>Company</th>
                    <th>Invoice Number</th>
                    <th>Product</th>
                    <th>Product Serial Number</th>
                    <th>HDD</th>
                    <th>HDD Serial Number</th>
                    <th>Original Date</th>
                    <th>Modified Date</th>
                    <?php
                    if($_SESSION['login_id']=='master'){
                        echo "<th>Modified user</th>";
                        echo "<th>Modified user</th>";
                    }
                    ?>
                    <th>Modify Type</th>
                </tr>
                <?php
                if($_SESSION['is_logged']=='YES'){
                    $log_query = "SELECT serial_log_id, id, invoice, company, dvr, dvr_serial, hdd, hdd_serial, 
                            original_date, modify_date, modify_user, user_ip, modify_type
                    FROM serial_log 
                    ORDER BY serial_log_id ASC;";

                    $result = mysqli_query($mysqli, $log_query);
                    if($result->num_rows >0){
                        while($row = mysqli_fetch_array($result)){
                            if($row["modify_type"]=='Before change'){
                                echo "<tr style='background-color:#006633'>";
                            } else if($row["modify_type"]=='After change'){
                                echo "<tr style='background-color:#00cc66'>";
                            } else if($row["modify_type"]=='remove'){
                                echo "<tr style='background-color:#ff6600'>";
                            }
                                echo "<td>".$row["serial_log_id"]."</td>";
                                echo "<td>".$row["id"]."</td>";
                                echo "<td>".$row["company"]."</td>";
                                echo "<td>".$row["invoice"]."</td>";
                                echo "<td>".$row["dvr"]."</td>";
                                echo "<td>".$row["dvr_serial"]."</td>";
                                echo "<td>".$row["hdd"]."</td>";
                                echo "<td>".$row["hdd_serial"]."</td>";
                                echo "<td>".$row["original_date"]."</td>";
                                echo "<td>".$row["modify_date"]."</td>";
                                if($_SESSION['login_id']=='master'){
                                    echo "<td>".$row["modify_user"]."</td>";
                                    echo "<td>".$row["user_ip"]."</td>";
                                }
                                echo "<td>".$row["modify_type"]."</td>";
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

                ?>
            </table>
    </body>

</html>