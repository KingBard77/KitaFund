<?php
include '../../config/db-config.php';
global $connection;

$Commission_Status = $_POST['Commission_Status'];
$Account_No = $_POST['Account_No'];
$Bank_Name = $_POST['Bank_Name'];
$Commission_Message = $_POST['Commission_Message'];
$id = $_POST['id'];

$sql = "UPDATE `comission` 
SET  `Commission_Status`= '$Commission_Status',
`Account_No`= '$Account_No', `Bank_Name`= '$Bank_Name', 
`Commission_Message`= '$Commission_Message'
 WHERE Commission_Id='$id' ";
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