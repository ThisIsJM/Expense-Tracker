<?php
require "includes/Profile.inc.php";
require "Header.php";

if(!isset($_SESSION['userId']))
{
    header("Location: ../Login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content ="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Comptabile" content="ie=edge">
        <title>Profile</title>
        <link rel="stylesheet" href="ProfileStyle.css">
    </head>

    <body>
        <?php
            echo'
            <div class = profileDetails>
                <h1 class = name><bold> HELLO,</bold><br>'.$firstNameUser.' '.$lastNameUser.'</h1>
                <div class = totalData>
                    <p>TOTAL INCOME</p>
                    <h1> '.$totalIncome.'</h1>
                </div>
                <div class = totalData>
                    <p>TOTAL EXPENSES</p>
                    <h1> '.$totalExpenses.'</h1>
                </div>
                <div class = totalData>
                    <p>BALANCE</p>
                    <h1> '.$balance.'</h1>
                </div>
            </div>';
        ?>
        <main>
            <!--CREATE CHART-->
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});

                var options = {backgroundColor: 'transparent'};

                google.setOnLoadCallback(function() {drawChart('piechart', 'incomepiechart'
                                        , <?php echo json_encode($incomeBreakdown);?>, options);});
                google.setOnLoadCallback(function() {drawChart('piechart', 'expensespiechart'
                                        , <?php echo json_encode($expensesBreakdown);?>, options);});

                google.setOnLoadCallback(function() {drawChart('linechart', 'incomelinechart'
                                        , <?php echo json_encode($totalDailyIncome);?>, options);});
                google.setOnLoadCallback(function() {drawChart('linechart', 'expenselinechart'
                                        , <?php echo json_encode($totalDailyExpenses);?>, options);});
                
                function drawChart(chartType, containerID, dataArray, options) 
                {
                    var data = google.visualization.arrayToDataTable(dataArray);
                    var containerDiv = document.getElementById(containerID);
                    var chart = false;

                    if (chartType.toUpperCase() == 'BARCHART') {
                        chart = new google.visualization.BarChart(containerDiv);
                    }
                    else if (chartType.toUpperCase() == 'COLUMNCHART') {
                        chart = new google.visualization.ColumnChart(containerDiv);
                    }
                    else if (chartType.toUpperCase() == 'PIECHART') {
                        chart = new google.visualization.PieChart(containerDiv);
                    }
                    else if (chartType.toUpperCase() == 'TABLECHART')
                    {
                        chart = new google.visualization.Table(containerDiv);
                    }
                    else if(chartType.toUpperCase() == 'LINECHART')
                    {
                        chart = new google.visualization.LineChart(containerDiv);
                    }

                    if (chart == false) 
                    {
                        return false;
                    }

                    chart.draw(data, options);
                }
            </script>
            <div class = "chartLayout">
                <div class = "chartLine">
                    <div class = "chart">
                        <table>
                            <tr><th>TOTAL INCOME BREAKDOWN</th></tr>
                            <tr><td><div id="incomepiechart" class = "income"></div><td><tr>
                        </table>
                    </div>

                    <div class = "chart">
                        <table>
                            <tr><th>TOTAL EXPENSES BREAKDOWN</th></tr>
                            <tr><td> <div id="expensespiechart" class = "expenses"></div><td><tr>
                        </table>
                    </div>
                </div>
                <div class = chartLine>
                    <div class = "chart">
                        <table>
                            <tr><th>DAILY TOTAL INCOME</th></tr>
                            <tr><td> <div id="incomelinechart" class = "income"></div><td><tr>
                        </table>
                    </div>

                    <div class = "chart">
                        <table>
                            <tr><th>DAILY TOTAL EXPENSES</th></tr>
                            <tr><td> <div id="expenselinechart" class = "expenses"></div><td><tr>
                        </table>
                    </div>
                </div>
             </div>
            </div>                
        </main>
    </body>
</html>