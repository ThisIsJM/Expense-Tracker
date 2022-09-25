<?php
session_start();

$username = $_SESSION['userUid'];
$userId =  $_SESSION['userId'];
   require "dbh.inc.php";

//Date Filter
$dateFilter = date("Y-m-d");

//Initialize the statement
$stmt = mysqli_stmt_init($conn);

//Tells whether all the data has been collected successfully 
$result = false;

//Get all the data of the user 
$sqlData = "SELECT * FROM finance WHERE uidUsers = ? ORDER BY transactionDate ASC";
$bindParam = array("s",$username);
$transactionData = getFromDatabase($sqlData,$bindParam,"result");

//Computes the total income and expenses of the table and also the remaining balance
$totalExpenses = computeTotalFilter("EXPENSES","ALL");
$totalIncome = computeTotalFilter("INCOME","ALL");
$balance = $totalIncome - $totalExpenses;

//Get all User Personal Information
$userDataResult= false;
$sqlUser = "SELECT * FROM users WHERE idUsers = ?";
$bindParam = array("i",$userId);
$userData = getFromDatabase($sqlUser,$bindParam,"userDataResult");

//First name and Last name
$firstNameUser = $userData[0]['firstNameUsers'];
$lastNameUser =  $userData[0]['lastNameUsers'];

function getFromDatabase($sql,$bindParam,$resultCheck)
{
    $data = array();
    $stmt = mysqli_stmt_init($GLOBALS['conn']);
    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        echo "SQL CODE NOT WORKING";
    }
    else
    {
        //Bind parameters to the placeholder
        mysqli_stmt_bind_param($stmt, $bindParam[0], $bindParam[1]); //SHOULD PUT MULTIPLE PARAMETERS DEPENDING ON THE SIZE OF THE ARRAY
        //Run parameters inside database
        mysqli_stmt_execute($stmt);
        $GLOBALS[$resultCheck] = mysqli_stmt_get_result($stmt);

    while($row = mysqli_fetch_assoc($GLOBALS[$resultCheck]))
        {
            $data[] = $row; //GET ARRAYS OF DATA INSIDE THE DATABASE
        }      
    }
    return $data;
}

function sortArrayDate($array)
{

}

function updateData($type,$description, $date, $amount,$id)
{
    $sql = "UPDATE finance SET amount = ? WHERE transactionType = ? AND descriptionTag = ? AND transactionDate = ? AND id = ?"; 
            $updatedstmt = $GLOBALS['stmt'];
             //Prepare the prepared statement
             if(!mysqli_stmt_prepare($updatedstmt,$sql))
             {
                 echo "Awit ayaw gumana lods";
             }
             else
             {   
                 //Bind parameters to the placeholder
                 mysqli_stmt_bind_param($updatedstmt, "isssi",$amount,$type,$description,$date,$id);
                 //Run parameters inside database
                 mysqli_stmt_execute($updatedstmt);
                 
                 header("Location: ../Home.php?updateexistingdata=success&type=".$type."&amount=".$amount."&description=".$description."&transactionDate=".$date);
             }
}

function deleteId($id)
{
    $sqlDelete = "DELETE FROM finance WHERE id = ?";

    //Creates a prepared statement
    $stmt = mysqli_stmt_init($GLOBALS['conn']);

    //Prepare the prepared statement
    if(!mysqli_stmt_prepare($stmt,$sqlDelete))
    {
        echo "Awit ayaw gumana lods";
    }
    else
    { 
        //Bind parameters to the placeholder
        mysqli_stmt_bind_param($stmt, "i",$id);
        //Run parameters inside database
        mysqli_stmt_execute($stmt);
        
        header("Location:../Home.php?deletedata=success");
    }
}

function computeTotalFilter($transactionType,$dateFilter)
{
    $filteredTransaction = array();
    $total = 0;
    $totalArray = array();

    //filter out array into an array containing only the specified transaction type
    foreach($GLOBALS['transactionData'] as $data)
    {
        if($data['transactionType'] == $transactionType)
        {
            //add it in the transaction array
            array_push($filteredTransaction,$data);
        }
    }

    //Checks the date filter
    if(strtoupper($dateFilter) == 'DAILY')
    {
        $previousDataDate = $filteredTransaction[0]['transactionDate'];
        $endDay = $filteredTransaction[sizeof($filteredTransaction)-1]['transactionDate'];
        $dailyTotal = 0;
        for($i=0; $i <sizeof($filteredTransaction); $i++)
        {
            //if transaction date is the same as the previous data then add its amount to the daily total
            if($filteredTransaction[$i]['transactionDate'] == $previousDataDate)
            {
                $dailyTotal += $filteredTransaction[$i]['amount'];
            }
            else //if its not the same day then 
            {
                //push the previous data's date and the total amount
                array_push($totalArray,[$previousDataDate,$dailyTotal]);
                //reset the daily total back to zero and add the amount of the current day amount 
                $dailyTotal = $filteredTransaction[$i]['amount'];
                //set the previous data day into the current day
                $previousDataDate = $filteredTransaction[$i]['transactionDate'];
            }
        }
            array_push($totalArray,[$filteredTransaction[sizeof($filteredTransaction)-1]['transactionDate'],$dailyTotal]);
            return $totalArray;
    }

    if(strtoupper($dateFilter) == 'ALL')
    {
        foreach($filteredTransaction as $data)
        {
            $total += $data['amount']; 
        }
        return $total;
    }
}

function getDailyTotal($transactionType, $date)
{
    $dailyTotals = computeTotalFilter($transactionType,"DAILY");
    foreach($dailyTotals as $dailyTotal)
    {
        if($dailyTotal[0] ==  $date)
        {
            return $dailyTotal[1];
        }
    }
    return 0;
}

function containsDescription($description,$dateTransaction,$type,$id)
{
    foreach($GLOBALS['transactionData'] as $data)
    {
        if($data['descriptionTag'] == $description && $data['transactionDate'] == $dateTransaction && $data['transactionType'] == $type && $data['id'] !=  $id)
        {
            return true;
        }
    }
    return false;
}

function getSpecificData($description,$dateTransaction,$type)
{

    foreach($GLOBALS['transactionData'] as $data)
    {
        if($data['descriptionTag'] == $description && $data['transactionDate'] == $dateTransaction && $data['transactionType'] == $type)
        {
            return $data;
        }
    }
}

