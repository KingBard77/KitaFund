<?php
include '../../config/db-config.php';
global $connection;

$Category_Name = $_POST['Category_Name'];
$id = $_POST['id'];

$sql = "UPDATE `category` 
        SET `Category_Name`='$Category_Name'
        WHERE Category_Id='$id' ";
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