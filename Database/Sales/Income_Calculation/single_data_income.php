<?php
include '../../config/db-config.php';
global $connection;

$id = $_POST['id'];
$sql = "SELECT Income_Id, Net_Expenses, Net_Income, Income_Date
FROM income
WHERE Income_Id='$id' LIMIT 1";
$query = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
