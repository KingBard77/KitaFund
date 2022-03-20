<?php 
include '../../config/db-config.php';
global $connection;

$id = $_POST['id'];
$sql = "SELECT l.Leave_Id, e.Employee_Code, l.Leave_Type, l.From_Date, 
l.To_Date, l.Leave_Message, l.Owner_Remark, l.Leave_Status, l.Apply_Date 
FROM leaves l, employee e 
WHERE l.Employee_Code = e.Profile_Id AND
l.Leave_Id='$id' LIMIT 1";
$query = mysqli_query($connection,$sql);
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
?>

