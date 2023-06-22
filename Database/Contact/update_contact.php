<?php
include '../config/db-config.php';
global $connection;

$contact_name = $_POST['contact_name'];
$contact_email = $_POST['contact_email'];
$contact_subject = $_POST['contact_subject'];
$contact_message = $_POST['contact_message'];
$contact_remark = $_POST['contact_remark'];
$contact_date = $_POST['contact_date'];
$id = $_POST['id'];

$sql = "UPDATE contact
        SET  `contact_name`='$contact_name', 
        `contact_email`='$contact_email', `contact_subject`='$contact_subject',
        `contact_message`='$contact_message',
        `contact_remark`='$contact_remark',
        `contact_date`='$contact_date'
        WHERE contact.contact_id='$id' ";
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