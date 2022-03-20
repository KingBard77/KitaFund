<?php 
include '../config/db-config.php';
global $connection;

$id = $_POST['id'];
$sql = "SELECT p.Profile_Id, e.Employee_Code, p.Image_Name, p.First_Name, p.Last_Name, 
p.Email, p.Phone, p.Joining_Date
FROM  employee e, profile p
WHERE e.Profile_Id = p.Profile_Id AND
p.Profile_Id='$id' LIMIT 1";
$query = mysqli_query($connection,$sql);
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
?>
