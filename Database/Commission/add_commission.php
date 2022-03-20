<?php 
include '../connection.php';

$Employee_Code = $_POST['Employee_Code'];
$Commission_Message = $_POST['Commission_Message'];
$Commission_Status = $_POST['Commission_Status'];
$Bank_Name = $_POST['Bank_Name'];
$Account_No = $_POST['Account_No'];
$Net_Commission = $_POST['Net_Commission'];
$Bonus = $_POST['Bonus'];
$Deduction = $_POST['Deduction'];
$Claiming = $_POST['Claiming'];
$Earning_Total = $_POST['Earning_Total'];
$Basic_Commission = $_POST['Basic_Commission'];

$sql = "INSERT INTO `comission` (`Basic_Commission`, `Earning_Total`, `Claiming`, `Deduction`, 
`Bonus`, `Net_Commission`, `Account_No`, `Bank_Name`, `Commission_Message`, `Employee_Code`, `Commission_Status`)
values ('$Basic_Commission', '$Earning_Total', '$Claiming' , '$Deduction', '$Bonus', '$Net_Commission' , 
'$Account_No' , '$Bank_Name' , '$Commission_Message' , '$Employee_Code' , '$Commission_Status' )";


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