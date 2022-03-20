<?php 
include '../../config/db-config.php';
global $connection;

$id = $_POST['id'];
$sql = "SELECT s.Stock_Id, s.Stock_Name, s.Quantity_In, s.Buying_Price, s.Selling_Price, s.Stock_Date,
c.Category_Name
FROM stock s, category c
WHERE s.Category_Id = c.Category_Id AND s.Stock_Id='$id' LIMIT 1";
$query = mysqli_query($connection,$sql);
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
?>



