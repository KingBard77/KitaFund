<?php
include '../../config/db-config.php';
global $connection;

$Purchase_Date = $_POST['Purchase_Date'];
$Purchase_Status = $_POST['Purchase_Status'];
$id = $_POST['id'];

$sql = "UPDATE `purchase` 
SET  `Purchase_Status`= '$Purchase_Status', `Purchase_Date`='$Purchase_Date'
WHERE Purchase_Id='$id' ";
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