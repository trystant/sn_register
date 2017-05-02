<?php
    
    include_once('../info.php');
    session_start();

    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }
    
    //$_SESSION['returnAddress'] = './index.php';
    
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="./ss.css"/>
        <title>RMA</title>
        <script src="jquery.min.js"></script>
        <script>
            $(document).ready(function(){



                
            });
        </script>
    </head>
    <body>
        
        <div align = "center">
            <h3></h3>
            <table border="1">
                <tr>
                    <th>TECH</th>
                    <th>RMA</th>
                    <th>Company</th>
                    
                    <th>Date Issued</th>
                    <th>Date Processed</th>
                    <th>Date Resolved</th>
                    
                </tr>
                <tr style='background-color:#fce5cd'>
                    <th>KO</th>
                    <th>R123456</th>
                    <th>SOME COMPANY</th>
                    
                    <th>JAN 18, 2017</th>
                    <th>MARCH 1, 2017</th>
                    <th>MARCH 1, 2017</th>
                    
                </tr>
            </table>
        </div>
        <div>
            <button>Return to Index</button>
            <br>
            <button>ADD</button>
        </div>

        <div>
            <br>
            <table border='1'>
                <tr>
                    <th>STATUS</th>
                    <th>Required Action</th>
                    <th>Product</th>
                    <th>Product Serial Number</th>    
                    <th>Original Invoice</th>
                    <th>Qty</th>
                    <th>Problem</th>
                    <th>Solution</th>
                    
                    <th>Tech Action!</th>
                </tr>
                <!--first item-->
                <tr style='background-color:yellow'>
                    <th>SOLVED</th>
                    <th>Warranty Repair</th>
                    <th>XIB 2032V-W</th>
                    <th>A16010000448</th>    
                    <th>NY3030303</th>
                    <th>1</th>
                    <th>NO VIDEO</th>
                    <th>REPLACE</th>
                    
                    <th><button style='width:40%'>Edit</button><button style='width:60%'>Remove</button></th>
                </tr>

                <tr style='background-color:cyan'>
                    <th>PENDING</th>
                    <th>Warranty Repair</th>
                    <th>XIB 2032V-B</th>
                    <th>A16010000581</th>    
                    <th>NY3030303</th>
                    <th>2</th>
                    <th>NO VIDEO</th>
                    <th>REPLACE</th>
                    <th><button style='width:40%'>Edit</button><button style='width:60%'>Remove</button></th>
                </tr>

                <tr>
                    <th>ISSUED</th>
                    <th>CREDIT</th>
                    <th>TIB 2032V-B</th>
                    <th>A17010000115</th>    
                    <th>NY3030304</th>
                    <th>1</th>
                    <th></th>
                    <th></th>
                    <th><button style='width:40%'>Edit</button><button style='width:60%'>Remove</button></th>
                </tr>
                <tr colspan='9' rowspan='2'></tr>
                <tr>
                    <th colspan='9' rowspan='1'>Note</th>
                </tr>
                <tr>
                    <td colspan='9' >
                        WATER DAMAGED
                    </td>
                </tr>



<?php
            


?>
            </table>
        </div>
    </body>
</html>