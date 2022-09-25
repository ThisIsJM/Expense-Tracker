<?php
   require "DataManager.inc.php";
  
//$date = date("Y-m-d");
if(isset($_POST['filterDate']))
{
    $GLOBALS['dateFilter'] = $_POST['dateInput'];
    header("Location:../Home.php?dateFilter=".$dateFilter);
}

$stmt = mysqli_stmt_init($conn);

//Delete a data
if(isset($_POST['delete']))
{
    $id = $_POST['delete'];
   deleteId($id);
}

$editID = 0;
//Specify the ID of the edited data
if(isset($_POST['edit']))
{
    $id = $_POST['edit'];

    $editID = $id;

    header("Location:../Home.php?editdata=ongoing&editID=".$id );
}
//Submit the edited data
if(isset($_POST['submit-edit']))
{
    $type = strtoupper($_POST['type-update']) ;
    $description = strtoupper($_POST['description-update']);
    $amount = $_POST['amount-update'];
    $id = $_POST['submit-edit'];
    $date = $_POST['date-update'];
    $hasSameAmount = false;

    //CHECKS IF DATABASE ALREADY CONTAIN THE SAME DESCRIPTION WITH THE SAME DATE BUT DIFFERENT ID
    if(containsDescription($description,$date,$type,$id))
    {
        deleteId($id);
        $existingData = getSpecificData($description,$date,$type);
        $amount += $existingData['amount']; 
        updateData($existingData['transactionType'],$existingData['descriptionTag'],$existingData['transactionDate'],$amount,$existingData['id']);
         //   header("Location: ../Home.php?updateexistingdata=success&type=".$type."&description=".$description."&amount=".$amount);
    }
    else
    {
        $sqlUpdate = "UPDATE finance SET transactionType = ?, descriptionTag = ?, amount = ?, transactionDate = ? WHERE id = ?";

        //Creates a prepared statement
        $stmt = mysqli_stmt_init($conn);

        //Prepare the prepared statement
        if(!mysqli_stmt_prepare($stmt,$sqlUpdate))
        {
            echo "Awit ayaw gumana lods";
        }
        else
        {
            //Bind parameters to the placeholder
            mysqli_stmt_bind_param($stmt, "ssisi", $type, $description, $amount, $date, $id);
            //Run parameters inside database
            mysqli_stmt_execute($stmt);
            
            header("Location: ../Home.php?updatecurrentdata=success&type=".$type."&description=".$description."&amount=".$amount);
        }
    }
}

//Submit data when enter button is pressed
if(isset($_POST['submit']))
{
    //session_start();
    //Table data variables
    $placeHolderId = 0;
    $uid =  $_SESSION['userUid'];
    $newDate = date("Y-m-d", strtotime($_POST['dateInput']));
    $type = strtoupper($_POST['type']) ;
    $description = strtoupper($_POST['description']);
    $amount = $_POST['amount'];

    if(!empty($description) || !empty($amount))
    {
        //CHECKS IF DATABASE ALREADY CONTAIN THE SAME DESCRIPTION WITH THE SAME DATE BUT DIFFERENT ID
        if(containsDescription($description,$newDate,$type, $placeHolderId))
        {
            $existingData = getSpecificData($description,$date,$type);
            $amount += $existingData['amount'];
            updateData($type,$description,$newDate,$amount,$existingData['id']);
        }
        else
        {
            //Insert data into SQL database
            $sql = "INSERT INTO finance (uidUsers, transactionType, descriptionTag, amount, transactionDate) 
                    VALUES (?,?,?,?,?);";

            //Creates a prepared statement
            $stmt = mysqli_stmt_init($conn);

            //Prepare the prepared statement
            if(!mysqli_stmt_prepare($stmt,$sql))
            {
                echo "Awit ayaw gumana lods";
            }
            else
            {
                //Bind parameters to the placeholder
                mysqli_stmt_bind_param($stmt, "sssis", $uid, $type, $description, $amount, $newDate);
                //Run parameters inside database
                mysqli_stmt_execute($stmt);
                
                header("Location: ../Home.php?inputData=success&uid=".$uid);
            }
        }
    }
    else
    {
        header("Location: ../home.php");
    }
}
?>