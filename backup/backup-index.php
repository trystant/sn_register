<?php
    include_once('./info.php');
    session_start();

    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }

    
?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        
        <title>Seiral Number Tracker</title>
        
        <script type="text/javascript">
            function validate(){
                
                var d = new Date();
                var year = d.getFullYear().toString();
                var month = (d.getMonth()+1).toString();
                var day = d.getDate().toString;
                var hours = d.toTimeString();
                
                var invoicenum = document.forms["serialregister"]["Invoicenum"].value;
                var company = document.forms["serialregister"]["Company"].value;
                
                if(invoicenum == null || invoicenum == ""){
                    alert("Invoice must be filled out.");
                    return false;
                }
                
                if(company == null || company == ""){
                    alert("Company must be filled out.");
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <div>
        <form name='serialregister' id='form1' method='post' onsubmit='return validate();' action='./query.php' >
            <input type='text' name='Invoicenum' placeholder='Invoice' autofocus/>
            <input type='text' name='Company' placeholder='Company name' required/>
            <input type='text' name='DVR_type' placeholder='DVR type'/>
            <input type='textarea' name='DVR_Seiral' placeholder='DVR Seiral #'/>
            <input type='text' name='HDD_type' placeholder='HDD type'/>
            <input type='text' name='HDD_Serial' placeholder='HDD Serial #'/>
            <!--<input type='text' name='Date'>-->
            <input type='submit' name='submit'/>
        </form>
        
        </div>
        
        <div>
            <table border="1">
                <tr>
                    <th>Invoice Number</th>
                    <th>Company</th>
                    <th>Product</th>
                    <th>Product Serial Number</th>
                    <th>HDD</th>
                    <th>HDD Serial Number</th>
                    <th>Date</th>
                </tr>
        <?PHP
        
            //$sql = "SELECT * FROM products WHERE 1 LIMIT 0 , 30";
            
            $sql = "SELECT 
                        dvr.invoice,
                        orders.company, 
                        dvr.dvr_model, dvr.dvr_serial, 
                        hdd.hdd, hdd.hdd_serial,
                        orders.month, orders.day, orders.year, orders.time
                    FROM dvr
                    INNER JOIN hdd
                        ON dvr.invoice = hdd.uid AND dvr.id = hdd.id
                    INNER JOIN orders
                        ON dvr.invoice = orders.invoice AND dvr.id = orders.id;
                    ";
            
                    //finish the line
            /*
            $result = $mysqli->query($sql);
            
            if($result->num_rows > 0){
                //while($row = $result->fetch_assoc()){
                while($row = $result->fetch_assoc()){
                    echo "<tr><td>".$row["invoice"]."</td><td>".$row["company"].
                    "</td><td>".$row["dvr_model"]."</td><td>".$row["dvr_serial"].
                    "</td><td>".$row["hdd"]."</td><td>".$row["hdd_serial"]."</td><td>"
                    .$row["month"]." ".$row["day"].", ".$row["year"]." ".$row["time"]."</td>";
                    echo "</tr>";
                }
            } else{
                echo "<tr><td>Empty<td></tr>";
            }
            */
            $result = mysqli_query($mysqli, $sql);
            
            if($result->num_rows > 0){
                //while($row = $result->fetch_assoc()){
                while($row = mysqli_fetch_array($result)){
                    echo "<tr><td>".$row["invoice"]."</td><td>".$row["company"].
                    "</td><td>".$row["dvr_model"]."</td><td>".$row["dvr_serial"].
                    "</td><td>".$row["hdd"]."</td><td>".$row["hdd_serial"]."</td><td>"
                    .$row["month"]." ".$row["day"].", ".$row["year"]." ".$row["time"]."</td>";
                    echo "</tr>";
                }
            } else{
                echo "<tr><td>Empty<td><td></td><td></td><td></td><td></td><td></td></tr>";
            }
        ?>
            </table>
        </div>
    </body>
    
</html>