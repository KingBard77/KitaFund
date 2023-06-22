<?php 
include '../config/db-config.php';
global $connection;

$id = $_POST['id'];
$sql = "SELECT volunteer_name, volunteer_email, volunteer_description, volunteer_remark, volunteer_date
FROM volunteer
WHERE volunteer_id='$id' LIMIT 1";
$query = mysqli_query($connection,$sql);
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
?>
