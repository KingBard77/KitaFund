<?php
include '../config/db-config.php';
global $connection;


$Leave_Type = $_POST['Leave_Type'];
$From_Date = $_POST['From_Date'];
$To_Date = $_POST['To_Date'];
$Leave_Message = $_POST['Leave_Message'];
$Owner_Remark = $_POST['Owner_Remark'];
$Leave_Status = $_POST['Leave_Status'];
$Apply_Date = $_POST['Apply_Date'];
$id = $_POST['id'];

$sql = "UPDATE `leaves` SET  `Leave_Type`='$Leave_Type' , `From_Date`= '$From_Date', `To_Date`='$To_Date',  `Leave_Message`='$Leave_Message', 
        `Owner_Remark`='$Owner_Remark', `Leave_Status`='$Leave_Status', `Apply_Date`='$Apply_Date' WHERE Leave_Id='$id' ";
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