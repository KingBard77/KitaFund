<?php
include '../../config/db-config.php';
global $connection;

$Action_Name = $_POST['Action_Name'];
$Attendance_Time = $_POST['Attendance_Time'];
$Attendance_Message = $_POST['Attendance_Message'];
$id = $_POST['id'];

$sql = "UPDATE `attendance` SET  `Action_Name`='$Action_Name' , `Attendance_Time`= '$Attendance_Time',   
`Attendance_Message`='$Attendance_Message' WHERE Attendance_Id='$id' ";
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