<?php
include '../../config/db-config.php';
global $connection;

$Total_Expenses = $_POST['Total_Expenses'];
$Net_Income = $_POST['Net_Income'];
$Income_Date = $_POST['Income_Date'];
$id = $_POST['id'];

$sql = "UPDATE `income` 
        SET  `Total_Expenses`='$Total_Expenses' , `Net_Income`= '$Net_Income', `Income_Date`='$Income_Date'
        WHERE Income_Id='$id' ";
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