<?php 
include '../config/db-config.php';
global $connection;

$id = $_POST['id'];
$sql = "SELECT contact_id, contact_name, contact_email, contact_subject, contact_message, contact_remark, contact_date
FROM  contact
WHERE contact_id='$id' LIMIT 1";
$query = mysqli_query($connection,$sql);
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
?>
