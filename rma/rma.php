<?php

    include_once('../info.php');
    session_start();
    
    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }

    $sql = "SELECT rma, company, walkin, hashkey, product, action, agent, qty, status, note
            FROM (
                SELECT
                rma_num.rma, rma_num.company, rma_num.walkin, rma_num.hashkey,
                rma_item.product, rma_item.action, rma_item.agent, rma_item.status,
                rma_item.qty, rma_num.note
                FROM rma_num
                INNER JOIN rma_item
                    ON rma_num.company = rma_item.company AND rma_num.hashkey = rma_item.hashkey
                ORDER BY rma DESC
                LIMIT 20) rma_num           
            ORDER BY rma ASC; ";

    $result = mysqli_query($mysqli, $sql);
    mysqli_close($mysqli);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
       
        <link type="text/css" rel="stylesheet" href="ss.css"/>
        
        <title>RMA</title>
        <script type="text/javascript">

        </script>
       
    </head>
    <body>
        <h3 align='center'>OVERVIEW</h3>
        <table>
            <tr>
            <?php
                if($_SESSION['rma_login_status']=='YES'){
                    echo "<td>";
                    echo "<a href='./rma_form.php'>Make RMA</a>";
                    echo "</td><td>";
                    echo "<a href='./rma_user_logout.php'>Logout</a>";
                    echo "</td>";
                } else{
                    echo "<td>";
                    echo "<a href='./rma_login.php'>Login</a>";
                    echo "</td>";
                }
            ?>
            </tr>
        </table>
        <div align = "center">    
            <br>
            <table border="1" id='main'>
                <tr>
                    <th>RMA</th>
                    <th>Company</th>
                    <th>Required <BR>Action</th>
                    <th>status</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <?php
                        if($_SESSION['rma_login_status']=='YES'){
                            echo "<th>Tech<br>Action!</th>";
                        }
                        
                    ?>
                </tr>
                <?php
                    $prev_rma = '';
                    if($result->num_rows >0){
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                            echo "<form name='update_rma' method='post' action='./b.php'>";
                            echo "<input type='hidden' name='rma_hash' value='".$row['hashkey']."'>";
                            if($prev_rma==$row['rma']){
                                echo "<td></td>";
                                echo "<td></td>";
                            } else{
                                echo "<td>".$row['rma']."</td>";
                                echo "<td>".$row['company']."</td>";
                                
                            }
                            echo "<td>".$row['action']."</td>";
                            echo "<td>".$row['status']."</td>";
                            echo "<td>".$row['product']."</td>";
                            echo "<td>".$row['qty']."</td>";
                            if($_SESSION['rma_login_status']=='YES' && $prev_rma!=$row['rma']){
                                echo "<td><input type='submit' value='Modify'/></td>";
                            } else{
                                echo "<td></td>";
                            }
                            $prev_rma = $row['rma'];
                            //echo "<input type='hidden' name='note' value='".$row['note']."'/>";
                            echo "</form>";
                            echo "</tr>";
                            
                        }
                    } 
                ?>
            </table>
        </div>
    </body>
</html>