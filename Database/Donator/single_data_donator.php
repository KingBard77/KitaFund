<?php 
include '../config/db-config.php';
global $connection;

$id = $_POST['id'];
$sql = "SELECT donator_id, donator_name, donator_email, donator_ic, donator_phone, 
donator_card_number, donator_name_holder, ccv, expired_date, amount, donator_date
FROM  donator
WHERE donator_id='$id' LIMIT 1";
$query = mysqli_query($connection,$sql);
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
?>
