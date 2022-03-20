<?php
include '../config/db-config.php';
global $connection;

$Image_Name = $_POST['Image_Name'];
$First_Name = $_POST['First_Name'];
$Last_Name = $_POST['Last_Name'];
$Email = $_POST['Email'];
$Phone = $_POST['Phone'];
$Joining_Date = $_POST['Joining_Date'];
$id = $_POST['id'];

$sql = "UPDATE profile
        SET  `Image_Name`='$Image_Name' ,`First_Name`='$First_Name', 
        `Last_Name`='$Last_Name', `Email`='$Email', 
        `Phone`='$Phone', `Joining_Date`='$Joining_Date' 
        WHERE profile.Profile_Id='$id' ";
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