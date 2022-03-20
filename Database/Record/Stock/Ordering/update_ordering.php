<?php
include '../../../config/db-config.php';
global $connection;

$Order_Date = $_POST['Order_Date'];
$Order_Status = $_POST['Order_Status'];
$id = $_POST['id'];

$sql = "UPDATE `ordering` 
SET  `Order_Status`= '$Order_Status', `Order_Date`='$Order_Date'
WHERE Order_Id='$id' ";
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