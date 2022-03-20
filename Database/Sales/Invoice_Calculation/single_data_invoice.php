<?php
include '../../config/db-config.php';
global $connection;

$id = $_POST['id'];
$sql = "SELECT Invoice_Id, Total, Overhead, Total_Cash, Total_Sales, Invoice_Message, Invoice_Date
FROM invoice
WHERE Invoice_Id='$id' LIMIT 1";
$query = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
