<?php

require "DataManager.inc.php";


//Total Income and Expenses Breakdown
$incomeBreakdown = getBreakdown("INCOME",$transactionData);
$expensesBreakdown = getBreakdown("EXPENSES",$transactionData);

//Daily Total Income and Expenses Amount
$totalDailyIncome =   computeTotalFilter("INCOME","DAILY");
$totalDailyExpenses = computeTotalFilter("EXPENSES","DAILY");

array_unshift($totalDailyIncome,['DATE','AMOUNT']);
array_unshift($totalDailyExpenses,['DATE','AMOUNT']);
//print_r($totalDailyIncome);
//Convert the total Income and Expenses breakdown into a string
//$incomeBreakdownString = arrangeChartElements($incomeBreakdown);
//$expensesBreakdownString = arrangeChartElements($expensesBreakdown);


//Create a string to arrange the breakdown for the chart
function arrangeChartElements($elements)
{
    $stringInput = '';
    foreach($elements as $element)
    {
       $stringInput .= ",['{$element[0]}',{$element[1]}]";
    }

    return $stringInput;
}

function getBreakdown($transactionType)
{
    $breakdown = array(['DESCRIPTION','AMOUNT']);
    $transaction = $GLOBALS['transactionData'];

    foreach($transaction as $data)
    {
        if($data['transactionType'] == $transactionType)
        {    
            $result = false;
            $placeholder = array();
            //push the description tag and amount inside the placeholder array
           array_push($placeholder,$data['descriptionTag'],$data['amount']);

            //check if the placeholder's description has something similar inside the breakdown array
            foreach($breakdown as &$element)
            {
                if(in_array($placeholder[0],$element))
                {
                    //adds the amount of the placeholder array into the breakdown array that has the same description
                    $element[1] += $placeholder[1];
                    $result = true; 
                }
            }
            if(!$result)
            {
                array_push($breakdown,$placeholder);
            }
        }
    }
    return $breakdown;
}

