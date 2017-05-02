<?php
    
    include_once('../info.php');
    session_start();
    /*
    echo print_r($_POST['hashkey']);
    if($_POST['rma_hash']==NULL){
        echo "rma_hash is null";
    } else if($_POST['rma_hash']==''){
        echo "rma_hash is empty";
    }
    */

    if($_POST['rma_hash']!=NULL){
        $_SESSION['rma_hash'] = $_POST['rma_hash'];
    }
    $sql = "SELECT
                rma_num.rma, rma_num.company, rma_num.walkin, rma_num.hashkey, rma_item.uid,
                rma_item.product, rma_item.action, rma_item.agent, rma_item.status,
                rma_item.qty, rma_num.issue_day, rma_num.issue_month, rma_num.issue_year, rma_num.issue_time,
                rma_item.proc_date, rma_item.proc_month, rma_item.proc_year, rma_item.proc_time,
                rma_item.finish_date, rma_item.finish_month, rma_item.finish_year, rma_item.finish_time,
                rma_item.problem, rma_item.solution, rma_item.psn, rma_item.invoice, rma_num.note
            FROM rma_num
            INNER JOIN rma_item
                ON rma_num.company = rma_item.company AND rma_num.hashkey = rma_item.hashkey
            WHERE rma_num.hashkey = '".$_SESSION['rma_hash']."';";
    
    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }

    $result = mysqli_query($mysqli, $sql);
    $result_c = mysqli_query($mysqli, $sql);
    mysqli_close($mysqli);
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
                
            }
            tr{
                background-color:#fce5cd;
                
            }
        </style>
        
    </head>
    <body>
        <div align = "center">
            <h3></h3>
            <?php/*
                echo print_r($_POST['hashkey']);
                if($_POST['hashkey']==NULL){
                    echo "hashkey is null";
                } else if($_POST['hashkey']==''){
                    echo "hashkey is empty";
                }*/
            ?>
            <table>
                <tr>
                    <th>TECH</th>
                    <th>RMA</th>
                    <th>Company</th>
                    <th>Date Issued</th>
                    <th>Date Processed</th>
                    <th>Date Resolved</th>
                </tr>
                <tr style=''>
                <?php
                    echo "<script>alert('".$sql."');</script>";
                    $companyInfo = mysqli_fetch_array($result_c);    
                    echo "<td>".$companyInfo['agent']."</td>";
                    echo "<td>".$companyInfo['rma']."</td>";
                    echo "<td>".$companyInfo['company']."</td>";
                    echo "<td>".$companyInfo['issue_month']." ".$companyInfo['issue_day'].", ".$companyInfo['issue_year']." ".$companyInfo['issue_time']."</td>";
                    if($companyInfo['proc_month'] != ''){
                        echo "<td>".$companyInfo['proc_month']." ".$companyInfo['proc_date'].", ".$companyInfo['proc_year']."</td>";
                    } else{
                        echo "<td></td>";
                    }
                    if($companyInfo['proc_month'] != ''){
                        echo "<td>".$companyInfo['finish_month']." ".$companyInfo['finish_date'].", ".$companyInfo['finish_year']."</td>";
                    } else{
                        echo "<td></td>";
                    }
                ?>             
                
                </tr>
            </table>
        </div>
        <div>
            <form method='get' action='./rma.php'>
                <input type="submit" value='Return to Index'/>
            </form>
            <br>
            <!--<button>ADD</button>-->
        </div>

        <div align = "center">
            <br>
            <table style='width:847px'>
                <!--item-->
                <?php
                    echo "<form method='post' id='refresh' action=''></form>";
                    if($result->num_rows>0){
                        $counter=1;
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                            if($_POST['m_enable']=='YES' && $_POST['row_ID']==$row['uid']){
                                echo "<th>STATUS</th>";
                                echo "<th>Required Action</th>";
                                echo "<th>Product</th>";
                                echo "<th>Product Serial Number</th>";
                                echo "<th>Original Invoice</th>";
                                echo "<th>Qty</th>";
                                echo "</tr><tr>";
                        //FORM: UPDATE{
                                echo "<form name='update_rma' method='post' action='./update.php'>";
                                echo "<td><input type='text' name='status' style='width:70px' value='".$row['status']."'></td>";
                                echo "<td><input type='text' name='action' style='width:70px'value='".$row['action']."'></td>";
                                echo "<td><input type='text' name='product' style='width:70px' value='".$row['product']."'></td>";
                                echo "<td><input type='text' name='psn' value='".$row['psn']."'></td>";
                                echo "<td><input type='text' name='invoice' value='".$row['invoice']."'></td>";
                                echo "<td><input type='text' name='qty' style='width:25px' value='".$row['qty']."'></td>";
                                echo "</tr><tr>";
                                echo "<th colspan='2'>Problem</th>";
                                echo "<th colspan='2'>Solution</th>";
                                echo "<th colspan='2'>Tech Action!</th>";
                                echo "</tr><tr style='height:25px'>";
                                echo "<td colspan='2'><input type='text' name='problem' value='".$row['problem']."'></td>";
                                echo "<td colspan='2'><input type='text' name='solution' value='".$row['solution']."'></td>";
                                echo "<input type='hidden' name='rma_hash' value='".$_POST['rma_hash']."'>";
                                echo "<input type='hidden' name='uid' value='".$row['uid']."'>";
                                echo "<td style='height:25px' colspan='2'><input type='submit' value='UPDATE' style='width:50%'>";
                                echo "</form>";
                        //FORM:}
                                echo "<input type='submit' value='Cancel' form='refresh' style='width:50%'></td>";
                            } else{
                                echo "<th>STATUS</th>";
                                echo "<th>Required Action</th>";
                                echo "<th>Product</th>";
                                echo "<th>Product Serial Number</th>";
                                echo "<th>Original Invoice</th>";
                                echo "<th>Qty</th>";
                                echo "</tr><tr>";
                        //FORM: CHANGE{
                                echo "<form action='' method='post'>";
                                echo "<td>".$row['status']."</td>";
                                echo "<td>".$row['action']."</td>";
                                echo "<td>".$row['product']."</td>";
                                echo "<td>".$row['psn']."</td>";
                                echo "<td>".$row['invoice']."</td>";
                                echo "<td>".$row['qty']."</td>";
                                echo "</tr><tr>";
                                echo "<th colspan='2'>Problem</th>";
                                echo "<th colspan='2'>Solution</th>";
                                echo "<th colspan='2'>Tech Action!</th>";
                                echo "</tr><tr>";
                                echo "<td colspan='2'>".$row['problem']."</td>";
                                echo "<td colspan='2'>".$row['solution']."</td>";
								$uid = $row['uid'];
                            //ROW ID
                                echo "<input type='hidden' name='row_ID' value='".$uid."'>";
                            //m_enable
                                echo "<input type='hidden' value='YES' name='m_enable'>";
                                echo "<td colspan='2'><input type='submit' value='CHANGE' style='width:40%'>";
                                echo "</form>";
                        //FORM:}
                        //FORM: RECTIFIED BUTTON{
                                echo "<form method='post' action='rectify.php' style='display:inline-block'>";
                                echo "<input type='hidden' value='".$uid."' name='uid'>";
                                echo "<input type='hidden' value='RECTIFIED' name='status'>";
                                echo "<input type='submit' value='Rectify' >";
                                echo "<input type='button' value='other'>";
                                echo "</td>";
                                echo "</form>";
                        //FORM:}
                                $counter++;
                            }
                        echo "</tr>";
                        }
                    }
                ?>
                <tr>
                    <th colspan='9' rowspan='1'>Note</th>
                </tr>
                <tr>
                    <td colspan='9' >
                        <?php
                            if($companyInfo['note']==NULL){
                                echo "empty";
                            } else{
                                echo $companyInfo['note'];
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
