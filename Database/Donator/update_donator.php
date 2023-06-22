<?php
include '../config/db-config.php';
global $connection;

$donator_name = $_POST['donator_name'];
$donator_email = $_POST['donator_email'];
$donator_ic = $_POST['donator_ic'];
$donator_phone = $_POST['donator_phone'];
$donator_card_number = $_POST['donator_card_number'];
$donator_name_holder = $_POST['donator_name_holder'];
$ccv = $_POST['ccv'];
$expired_date = $_POST['expired_date'];
$amount = $_POST['amount'];
$donator_date = $_POST['donator_date'];
$id = $_POST['id'];

$sql = "UPDATE donator
        SET  `donator_name`='$donator_name', 
        `donator_card_number`='$donator_card_number', `donator_name_holder`='$donator_name_holder',
        `ccv`='$ccv', `expired_date`='$expired_date', `amount`='$amount',
        `donator_date`='$donator_date'
        WHERE donator.donator_id='$id' ";
$query= mysqli_query($connection,$sql);
$lastId = mysqli_insert_id($connection);
if($query ==true)
{
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>