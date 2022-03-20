<?php
include '../../config/db-config.php';
global $connection;


$Quantity_Open = $_POST['Quantity_Open'];
$Quantity_Close = $_POST['Quantity_Close'];
$Quantity_Balance = $_POST['Quantity_Balance'];
$SubTotal = $_POST['SubTotal'];
$Sales_Date = $_POST['Sales_Date'];
$id = $_POST['id'];

$sql = "UPDATE `sales` 
        SET  `Quantity_Open`='$Quantity_Open' , 
        `Quantity_Close`= '$Quantity_Close', 
        `Quantity_Balance`='$Quantity_Balance', 
        `SubTotal`='$SubTotal', 
        `Sales_Date`='$Sales_Date'
        WHERE Sales_Id='$id' ";
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