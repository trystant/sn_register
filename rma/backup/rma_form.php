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
            $("#rma_table").find("tr").hover(function(){
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
        <form name='add_row' id='add' method='post' action='./rma_form.php'>
        </form>
        <table align='center' id='rma_table'>
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
            <tr>
                <td>
                    <select name='request_action' form='rev' style='width: 100px'>
                        <option value='WARRANTY REPAIR'>WARRANTY REPAIR</option>
                        <option value='CREDIT'>CREDIT</OPTION>
                        <option value='RMA'>RMA</option>
                        <option value='EXCHANGE'>EXCHANGE</option>
                        <option value='OUT OF WARRANTY REPAIR'>OUT OF WARRANTY REPAIR</option>
                        <option value='PRICE ADJUSTMENT'>PRICE ADJUSTMENT</option>
                        <option value='RESTOCK'>RESTOCK</option>
                        <option value='ADVANCED REPLACEMENT'>ADVANCED</option>
                    </select>
                </td>
                <td>
                    <input type='text' form='rev' name='rev_product_1' autofocus/>
                </td>
                <td>
                    <input type='text' form='rev' name='rev_qty_1'/>
                </td>
                <td>
                    <input type='text' form='rev' name='rev_prob_1'/>
                </td>
                <td>
                    <input type='text' form='rev' name='rev_oi_1'/>
                </td>
		        <td>
                    <script language='javascript'>
                        var counter = 2;
                        function addRow(){
                            var table = document.getElementById('rma_table');
                            
                            var row = table.insertRow();
                            row.setAttribute("id", counter);

                            var cell0 = row.insertCell(0);
                            var cell1 = row.insertCell(1);
                            var cell2 = row.insertCell(2);
                            var cell3 = row.insertCell(3);
                            var cell4 = row.insertCell(4);
                            var cell5 = row.insertCell(5);
                            
                            var action = "<select name='request_action_"+counter+"' form='rev' style='width: 100px'>";
                            action += "<option value='WARRANTY REPAIR'>WARRANTY REPAIR</option>";
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
                            cell1.innerHTML = "<input type='text' form='rev' name='rev_product_"+counter+"' value='"+(counter+1)+"'>";
                            cell2.innerHTML = "<input type='text' form='rev' name='rev_qty_"+counter+"'/>";
                            cell3.innerHTML = "<input type='text' form='rev' name='rev_prob_"+counter+"'/>";
                            cell4.innerHTML = "<input type='text' form='rev' name='rev_oi_"+counter+"'/>";
                            cell5.innerHTML = "<button onclick='rmRow("+row+")'>Remove Row "+(counter+1)+"</button>";
                            counter++;
                        }
                        
                        function rmRow(c){
                            
                            alert(c.rowIndex);
                            document.getElementById('rma_table').deleteRow(c.rowIndex);
                            
                        }
                    </script>
                    <button onclick='addRow()'>Add Row</button>
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
                    <input type='submit' form='rev' onclick='verify()' value='Finish'/>
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
