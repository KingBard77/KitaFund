<?php 
include '../config/db-config.php';
global $connection;

$id = $_POST['id'];
$sql = "SELECT a.Attendance_Id, e.Employee_Code, a.Action_Name, a.Attendance_Time, a.Attendance_Message
FROM attendance a, employee e
WHERE a.Employee_Code = e.Profile_Id AND
a.Attendance_Id='$id' LIMIT 1";
$query = mysqli_query($connection,$sql);
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
?>

