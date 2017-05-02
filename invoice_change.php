<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="ss.css"/>
        <title>Invoice Change</title>
        
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
        <div align='center'>
            <form name='invoice_change' method='post' action='./invoice_change_query.php'>
                Company: <input type='text' name='company'autofocus/><br>
                Change invoice from <input type='text' name='before'/> 
                to<input type='text' name='after'/>
                <input type='submit' name='submit'/>
            </form>
        </div>
    </body>
</html>