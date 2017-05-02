<?php
    session_start();
    if($_SESSION['rma_login_status']!='YES'){
        header('Location: ./rma_login.php');
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>    
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="ss.css"/>
        <title>RMA Complete Form</title>
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
        
    <script src="jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            addRow(3);
            $(document).on('click', '#delRow', function(){
                $(this).closest("tr").remove();
            });
            $("#rma_table").find("tr").hover(
                function(){
                    $(this).css("background-color", "#ffef96");
                }, function(){
                    $(this).css("background-color", "#ffffff");
                }
            );
            /*  Todo: 
                    ** Implement quote removal on submit **

            $(document).on('click', '#finish', function () {
                //var x = $(this).val().replace(/'/g, '\'').replace(/"/g, '\"');
                //var x = $(this).val();
                //$(this).val( $(this).val().replace(/['"]/g, "") );
                //var x = $(":contains('a')").replacewith("b");
                //$("input:text").val($(this).val().replace(/['"]/g, ''));
                $("[type=text]:contains('a')").closest("table").css("border", "1");
                //alert(x);
                //var x = $(this).val().replace(/'/g, '').replace(/"/g, '');
                
                // go on with processing data
            });
            */
            
            $("input:text").keyup(function(){
                $(this).val( $(this).val().replace(/['"]/g, ''));
            });
            
        });
        
    </script>

    <script language='javascript'>
        function addRow(r){
            var table = document.getElementById('rma_table');
            var row = table.insertRow(r);

            var cell0 = row.insertCell(0);
            var cell1 = row.insertCell(1);
            var cell2 = row.insertCell(2);
            var cell3 = row.insertCell(3);
            var cell4 = row.insertCell(4);
            var cell5 = row.insertCell(5);
            var cell6 = row.insertCell(6);
            
            var action = "<select name='request_action[]' form='rev' style='width: 100px'>";
            action += "<option value='WARRANTY REPAIR'>WARRANTY REPAIR</option>";
            action += "<option value='CREDIT'>CREDIT</option>";
            action += "<option value='RMA'>RMA</option>";
            action += "<option value='EXCHANGE'>EXCHANGE</option>";
            action += "<option value='OUT OF WARRANTY REPAIR'>OUT OF WARRANTY REPAIR</option>";
            action += "<option value='PRICE ADJUSTMENT'>PRICE ADJUSTMENT</option>";
            action += "<option value='RESTOCK'>RESTOCK</option>";
            action += "<option value='ADVANCED REPLACEMENT'>ADVANCED</option>";
            action += "</select>";
            cell0.innerHTML = action;
            cell1.innerHTML = "<input type='text' form='rev' name='rev_product[]' style='width:100%'/>";
            cell2.innerHTML = "<input type='text' form='rev' name='rev_qty[]' style='width:30px'/>";
            cell3.innerHTML = "<input type='text' form='rev' name='rev_prob[]' style='width:100%'/>";
            cell4.innerHTML = "<input type='text' form='rev' name='rev_oi[]' style='width:100%'/>";
            cell5.innerHTML = "<input type='text' form='rev' name='rev_sn[]'/><br><button>Scan Database</button>";
            cell6.innerHTML = "<button onclick='addRow()'>+</button>";
            cell6.innerHTML += "<input type='button' value='-' id='delRow'/>";
        }
    </script>

   <body>
        <h1 align='center'>RMA REQUEST FORM</h1>
        
        <form name='revised_rma' id='rev' method='post' action='./rma_query.php'>
        </form>
        <!--
        <form name='add_row' id='add' method='post' action='./rma_form.php'>
        </form>
        -->
        <div align='center'>
            <form action='./rma.php'>
                <input type="submit" value='Return to Index'>
            </form>
        </div>
        <table align='center' id='rma_table'>
            <tr>
                <td>
                    <input type='radio' form='rev' name='walkin' value='yes' checked autofocus>Walk-in
                </td>
                <td>
                    <input type='radio' form='rev' name='walkin' value='no'>UPS
                </td>
            </tr>
            <tr>
                <td>COMPANY</td>
                <td>
                    <input type='text' form='rev' name='rev_company'/>
                </td>
                <td>
                    TECH:
                </td>
                <td>
                <?php
                    echo $_SESSION['rma_id'];
                    echo "<input type='hidden' form='rev' name='technician' value='".$_SESSION['rma_id']."'/>";
                ?>
                </td>
                
		<td>
		    
            <button onclick='addRow(2)'>Add Line</button>
            
		</td>
            </tr>

            <tr>
                <td>
                    ACTION
                </td>
                <td>
                    PRODUCT
                </td>
                <td>
                    QTY
                </td>
                <td>
                    PROBLEM
                </td>
                <td>
                    ORIGINAL INVOICE
                </td>
                <td>
                    Serial Number
                </td>
            </tr>
        </table>
        <br>
        <table align='center' border='1'>
            <tr>
                <td align='center' colspan='5'>
                    NOTE
                </td>
                <td rowspan='2'>
                    <input type='submit' form='rev' value='Finish'/>
                </td>
            </tr>	
            <tr>
                <td colspan='5'>
                    <textarea rows='2' cols='90' name='note' form='rev'/>
                    </textarea>
                </td>
            </tr>
        </table>
    </body>
</html>
