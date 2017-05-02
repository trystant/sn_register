<?php

    include_once('./info.php');
    session_start();

    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], 'New Serial');

    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }
    

?>
<!DOCTYPE HTML>
<html>
    <body>
        <table border='1'>
            <tr>
                <th>Day</th>
                <th>Company</th>
                <th>Invoice</th>
                <th>Unit</th>
                <th>HDD</th>
                <th>Serial#</th>
                <th>DVR#</th>
                <th>ID</th>
            </tr>

        <?php


            $sql = "SELECT *
                    FROM old_hdd
                    ;";
            
            $result = mysqli_query($mysqli, $sql);

            if($result->num_rows>0){
                while($row=mysqli_fetch_array($result)){
                    echo "<tr>";
                    /*
                    if(strlen($row['date'])==0){
                        echo "<td>".$curr_date."</td>";
                    } else{
                        echo "<td>".$row['date']."</td>";
                        $curr_date = $row['date'];
                    }*/

                    echo "<td>".$row['date']."</td>";
                    /*
                    if(strlen($row['company'])==0){
                        echo "<td>".$curr_company."</td>";
                    } else{
                        echo "<td>".$row['company']."</td>";
                        $curr_company = $row['company'];
                    }*/
                    echo "<td>".$row['company']."</td>";

                    echo "<td>".$row['invoice']."</td>";
                    echo "<td>".$row['unit']."</td>";
                    echo "<td>".$row['hdd']."</td>";
                    echo "<td>".$row['hdd_s']."</td>";
                    echo "<td>".$row['unit_s']."</td>";
                    echo "<td>".$row['id']."</td>";
                    echo "</tr>";

                }
            }
        ?>
        </table>
    </body>
</html>
