<?php
    include_once('./info.php');
    session_start();
    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }  
    $_SESSION['old_return'] = './old_search.php';
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
                        $(this).css("background-color", "#ffffff");
                });
            });
        </script>
        <title>Old Serial Search</title>
        
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
        <br>
        <div align = 'center'>

            <h2>Old Serial Search</h2>
            <p>(Feb 27, 2014 ~ Dec 2016)<p>
            <form name='search' method='post' action='./old_search_q.php'>
                <input type='text' id='raw_search_key' name = 'key' autofocus required/>
                <input type='submit' name='Submit'/>
            </form>
        </div>
        <br>
        <div align = "center">
            <h3></h3>
            <table id='list' border="1">
                <tr>
                    <th>Date</th>
                    <th>Company</th>
                    <th>Invoice Number</th>
                    <th>Unit</th>
                    <th>HDD</th>
                    <th>HDD Serial Number</th>
                    <th>Product Serial Number</th>
                    <th>ID</th>
                </tr>

                <?PHP
                    $s_result = mysqli_query($mysqli, $_SESSION['old_search_result']);
                    //echo $_SESSION['old_search_result'];
                    $prev_comp = '';
                    $prev_date = '';
                    if($s_result->num_rows > 0){
                        while($row = mysqli_fetch_array($s_result)){
                            echo "<tr>";
                            if($row['date'] != $prev_date){
                                $prev_date = $row['date'];
                                echo "<td>".$row['date']."</td>";
                            } else{
                                echo "<td></td>";
                            }
                            if($row['date'] != $prev_comp){
                                $prev_comp = $row['company'];
                                echo "<td>".$row['company']."</td>";
                            } else{
                                echo "<td></td>";
                            }
                            echo "<td>".$row['invoice']."</td>";
                            echo "<td>".$row['unit']."</td>";
                            echo "<td>".$row['hdd']."</td>";
                            echo "<td>".$row['hdd_s']."</td>";
                            echo "<td>".$row['unit_s']."</td>";
                            echo "<td>".$row['id']."</td>";
                            echo "</tr>";
                        }
                    }
                    mysqli_close($mysqli);
                ?>
            </table>
        </div>
        
    </body>
</html>


<tr>
    <td></td>    
</tr>
