<!DOCTYPE html>
<html>
    <head>
        <title>RMA Complete Form</title>
    </head>
    <script src="jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("p").click(function(){
                $(this).hide();
            });
            $("tr").hover(function(){
                $(this).css("background-color", "#ffef96");
            },
            function(){
                $(this).css("background-color", "#ffffff");
            }
            )
        });
    </script>
    <body>
        <h1 align='center'>RMA REQUEST FORM</h1>
        <form name='revised_rma' id='rev' method='post' action='./a.php'>
        </form>
        <form name='add_row' id='add' method='post' action='./rma_form_php.php'>
        </form>
        <table align='center' id='rma_table' border='1'>
            <tr>
                <td>COMPANY</td>
                <td>
                    <input type='text' form='rev' name='rev_company' autofocus/>
                </td>
                <td></td>
                <td>
                    TECHNICIAN
                </td>
                <td>
                    whoever
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
                    ADD
                </td>
            </tr>
<?php
    
            echo "<tr>";
                echo "<td>";
                    echo "<select name='request_action' form='rev' style='width: 100px'>";
                        echo "<option value='WARRANTY REPAIR'>WARRANTY REPAIR</option>";
                        echo "<option value='CREDIT'>CREDIT</OPTION>";
                        echo "<option value='RMA'>RMA</option>";
                        echo "<option value='EXCHANGE'>EXCHANGE</option>";
                        echo "<option value='OUT OF WARRANTY REPAIR'>OUT OF WARRANTY REPAIR</option>";
                        echo "<option value='PRICE ADJUSTMENT'>PRICE ADJUSTMENT</option>";
                        echo "<option value='RESTOCK'>RESTOCK</option>";
                        echo "<option value='ADVANCED REPLACEMENT'>ADVANCED</option>";
                    echo "</select>";
                echo "</td>";
                echo "<td>";
                    echo "<input type='text' form='rev' name='rev_product_1' autofocus/>";
                echo "</td>";
                echo "<td>";
                    echo "<input type='text' form='rev' name='rev_qty_1'/>";
                echo "</td>";
                echo "<td>";
                    echo "<input type='text' form='rev' name='rev_prob_1'/>";
                echo "</td>";
                echo "<td>";
                    echo "<input type='text' form='rev' name='rev_oi_1'/>";
                echo "</td>";
		        echo "<td>";
                    echo "<input type='submit' form='add' value='Add Row'/>";
                echo "</td>";
            echo "</tr>";
?>
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
