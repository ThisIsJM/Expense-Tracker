<?php
require 'includes/Home.inc.php';
require "Header.php";


if(!isset($_SESSION['userId']))
{
    header("Location: ../Login.php");
    exit();
}
if(isset($_GET['dateFilter']))
{
    $dateFilter = $_GET['dateFilter'];
}
else
{
    $dateFilter = date('Y-m-d');
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content ="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Comptabile" content="ie=edge">
        <title>Home</title>
        <link rel="stylesheet" href="HomeStyle.css">
    </head>

    <body>
        <main>
            <!-- Total Table-->
            <div class = total>
                <table>
                    <tr>
                        <th>INCOME</th>
                        <th>EXPENSES</th>
                        <th>BALANCE</th>
                    </tr>
                    <tr>
                        <?php
                        echo'<td>'.getDailyTotal('INCOME',$dateFilter).'</td>
                            <td>'.getDailyTotal('EXPENSES',$dateFilter).'</td>
                            <td>'.getDailyTotal('INCOME',$dateFilter) - getDailyTotal('EXPENSES',$dateFilter).'</td>';
                        ?>
                    </tr>
                </table>
            </div>
            
            <!-- Date Filter-->
                <form action="includes/Home.inc.php" method = "post" class = "dateSearch">
                    <input type = "date" name = "dateInput" value = <?php if(isset($_GET['dateFilter'])){echo$_GET['dateFilter'];} else{echo date("Y-m-d");};?>>
                    <button type="submit" name="filterDate" >
                        <ion-icon name="search"></ion-icon>
                    </button>
                </form>
            <!-- Main Table that includes Transaction Details-->
            <div class = transaction>
                <table>
                    <tr>
                        <th>TRANSACTION TYPE</th>
                        <th>DESCRIPTION</th>
                        <th>AMOUNT</th>
                        <th> DATE </th>
                    </tr>
                    <!-- Print out all the entry of the user in finance table-->  
                        <?php
                            if($result)
                            {
                                foreach($transactionData as $data)
                                {
                                   $transactionType = $data['transactionType'];
                                    $descriptionTag = $data['descriptionTag'];
                                    $amountData = $data['amount'];
                                    $transactionDate = $data['transactionDate'];
                                    $id = $data['id'];
                                    if(isset($_GET['dateFilter']))
                                    {
                                        $dateFilter = $_GET['dateFilter'];
                                    }
                                    if($transactionDate == $dateFilter)
                                    {
                                        if(isset($_GET['editID']))
                                        {
                                            $editID = $_GET['editID'];
                                        }
                                        else
                                        {
                                            $editID = 0;
                                        }
                                        if($editID != $id)
                                        {
                                        echo'
                                        <tr>
                                            <td>' .$transactionType. '</td>
                                            <td>' .$descriptionTag. '</td>
                                            <td>' .$amountData. '</td>
                                            <td>' .$transactionDate. '
                                                <button name="menu" class = "menu" value = "'.$id.'">
                                                    <ion-icon name="ellipsis-vertical"></ion-icon>
                                                </button>
                                                <form action="includes/Home.inc.php" method = "post" class = menuform>
                                                    <ul id = "myOptions" class = "options">
                                                        <li><button name="edit" value = "'.$id.'"> EDIT</button></li>
                                                        <li><button name="delete" value = "'.$id.'"> DELETE</button></li>
                                                    </ul>
                                                </form>
                                            </td>
                                        </tr>';
                                        }
                                        else
                                        {
                                            $selected = '';
                                            if($transactionType == 'EXPENSES')
                                            {
                                            $selected =  '<option value = "INCOME">INCOME</option>
                                                <option selected value = "EXPENSES">EXPENSES</option>';
                                            }
                                            else
                                            {
                                                $selected =  '<option selected value = "INCOME">INCOME</option>
                                                <option value = "EXPENSES">EXPENSES</option>';
                                            }
                                            echo'
                                            <form action="includes/Home.inc.php" method = "post">
                                            <tr>
                                                <td>
                                                    <select name = "type-update" id = "type">'.$selected.'</select>
                                                </td>
                                                <td>
                                                    <input type = "text" name = "description-update" value = "'.$descriptionTag.'" placeholder="'.$descriptionTag.'">
                                                </td>
                                                <td>
                                                    <input type = "number" name = "amount-update" min = "0" max = "999999999" value = "'.$amountData.'" placeholder="'.$amountData.'">
                                                </td>
                                                <td>
                                                    <input type = "date" name = date-update value = '.$transactionDate.'>
                                                </td>
                                            </tr>
                                            <button type="submit" name="submit-edit" value = "'.$id.'">
                                            </form>';
                                        }
                                    }
                                }                                
                            }
                        ?>
                    <!-- Row for when adding new entry inside the table-->
                    <form action="includes/Home.inc.php" method = "post">
                        <tr>
                            <td>
                                <select name = "type" id = "type">
                                    <option value = "INCOME">INCOME</option>
                                    <option value = "EXPENSES">EXPENSES</option>
                                </select>
                            </td>
                            <td>
                                <input type = "text" name = "description" placeholder="DESCRIPTION">
                            </td>
                            <td>
                                <input type = "number" name = "amount" min = '0' max = '999999999' placeholder="0">
                            </td>
                            <td>
                                <input type = "date" name = "dateInput" value = <?php echo $date = date("Y-m-d")?>>
                            </td>
                            
                        </tr>
                </table>
                         <button type="submit" name="submit">
                            <!--ion-icon name="add-circle-outline"></ion-icon-->
                         </button>
                    </form>
            </div>
        </main>

        <!-- Ionicon Script Reference-->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"> </script>
    </body> 
</html>