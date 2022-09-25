<?php

$servername = "localHost";
$dBUsername = "root";
$dbPassword = "";
$dBName = "expensetracker";

$conn = mysqli_connect($servername,$dBUsername,$dbPassword,$dBName);
if(!$conn)
{
    die("Connection failed: ".mysqli_connect_error());
}