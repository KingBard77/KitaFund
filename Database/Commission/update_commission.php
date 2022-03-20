<?php
include '../config/db-config.php';
global $connection;

$Commission_Date = $_POST['Commission_Date'];
$Basic_Commission = $_POST['Basic_Commission'];
$Commission_Status = $_POST['Commission_Status'];
$Earning_Total = $_POST['Earning_Total'];
$Claiming = $_POST['Claiming'];
$Deduction = $_POST['Deduction'];
$Bonus = $_POST['Bonus'];
$Net_Commission = $_POST['Net_Commission'];
$Account_No = $_POST['Account_No'];
$Bank_Name = $_POST['Bank_Name'];
$Commission_Message = $_POST['Commission_Message'];
$id = $_POST['id'];

$sql = "UPDATE `comission` 
SET  `Commission_Date`='$Commission_Date' , `Basic_Commission`= '$Basic_Commission', `Commission_Status`= '$Commission_Status',
`Earning_Total`='$Earning_Total',  `Claiming`='$Claiming', `Deduction`= '$Deduction', `Bonus`= '$Bonus', 
`Net_Commission`= '$Net_Commission', `Account_No`= '$Account_No', `Bank_Name`= '$Bank_Name', 
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