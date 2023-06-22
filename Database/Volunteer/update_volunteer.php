<?php
include '../config/db-config.php';
global $connection;

$volunteer_name = $_POST['volunteer_name'];
$volunteer_email = $_POST['volunteer_email'];
$volunteer_description = $_POST['volunteer_description'];
$volunteer_remark = $_POST['volunteer_remark'];
$volunteer_date = $_POST['volunteer_date'];
$id = $_POST['id'];

$sql = "UPDATE volunteer
        SET  `volunteer_name`='$volunteer_name', 
        `volunteer_email`='$volunteer_email', `volunteer_description`='$volunteer_description',
        `volunteer_remark`='$volunteer_remark',
        `volunteer_date`='$volunteer_date'
        WHERE volunteer.volunteer_id='$id' ";
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