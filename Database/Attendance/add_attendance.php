<?php 
include('../connection.php');

$Employee_Code = $_POST['Employee_Code'];
$Attendance_Message = $_POST['Attendance_Message'];
$Action_Name = $_POST['Action_Name'];

$sql = "INSERT INTO `attendance` ( `Action_Name`,`Attendance_Message`, `Employee_Code`)
 values ('$Action_Name',  '$Attendance_Message', '$Employee_Code')";
$query= mysqli_query($dbc,$sql);
$lastId = mysqli_insert_id($dbc);
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