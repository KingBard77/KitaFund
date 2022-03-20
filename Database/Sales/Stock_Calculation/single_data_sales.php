<?php
include '../../config/db-config.php';
global $connection;

$id = $_POST['id'];
$sql = "SELECT s.Sales_Id, s.Quantity_Open, s.Quantity_Close, s.Quantity_Balance, s.SubTotal, 
s.Sales_Date, c.Stock_Name, c.Quantity_In, c.Selling_Price
FROM sales s JOIN stock c ON s.Stock_Id = c.Stock_Id
WHERE Sales_Id='$id' LIMIT 1";
$query = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
