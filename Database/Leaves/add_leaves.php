<?php 
include '../connection.php';

$Leave_Status = $_POST['Leave_Status'];
$Owner_Remark = $_POST['Owner_Remark'];
$Leave_Message = $_POST['Leave_Message'];
$To_Date = $_POST['To_Date'];
$From_Date = $_POST['From_Date'];
$Leave_Type = $_POST['Leave_Type'];
$Employee_Code = $_POST['Employee_Code'];

$sql = "INSERT INTO `leaves` 
(`Employee_Code`,`Leave_Type`,`From_Date`,`To_Date`,`Leave_Message`,`Owner_Remark`,`Leave_Status`) 
values 
('$Employee_Code', '$Leave_Type', '$From_Date', '$To_Date', '$Leave_Message', '$Owner_Remark', '$Leave_Status')";

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