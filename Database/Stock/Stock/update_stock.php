<?php
include '../../config/db-config.php';
global $connection;

$Stock_Date = $_POST['Stock_Date'];
$Selling_Price = $_POST['Selling_Price'];
$Buying_Price = $_POST['Buying_Price'];
$Quantity_In = $_POST['Quantity_In'];
$Category_Name = $_POST['Category_Name'];
$Stock_Name = $_POST['Stock_Name'];
$id = $_POST['id'];

$sql = "UPDATE `stock` 
        INNER JOIN category ON stock.Category_id = category.Category_id
        SET `Stock_Name`='$Stock_Name' , `Quantity_In`= '$Quantity_In', `Buying_Price`='$Buying_Price',  
            `Selling_Price`='$Selling_Price', `Stock_Date`='$Stock_Date', `Category_Name`='$Category_Name'
        WHERE stock.Stock_Id='$id' ";
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