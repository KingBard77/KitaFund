<?php
include '../../config/db-config.php';
global $connection;

$Total = $_POST['Total'];
$Overhead = $_POST['Overhead'];
$Total_Cash = $_POST['Total_Cash'];
$Total_Sales = $_POST['Total_Sales'];
$Invoice_Message = $_POST['Invoice_Message'];
$Invoice_Date = $_POST['Invoice_Date'];
$id = $_POST['id'];

$sql = "UPDATE `invoice` 
        SET  `Total`='$Total' , `Overhead`= '$Overhead', `Total_Cash`='$Total_Cash', 
         `Total_Sales`='$Total_Sales', `Invoice_Message`='$Invoice_Message', `Invoice_Date`='$Invoice_Date'
        WHERE Invoice_Id='$id' ";
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