<?php 
include '../../config/db-config.php';
global $connection;

$id = $_POST['id'];
$sql = "SELECT Category_Id, Category_Name
FROM category 
WHERE Category_Id ='$id' LIMIT 1";
$query = mysqli_query($connection,$sql);
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
?>



