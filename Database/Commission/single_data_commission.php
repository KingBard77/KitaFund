<?php 
include '../config/db-config.php';
global $connection;

$id = $_POST['id'];
$sql = "SELECT c.Commission_Id, e.Employee_Code, c.Commission_Date, c.Commission_Status,
c.Basic_Commission, c.Earning_Total, c.Claiming, c.Deduction, c.Bonus, c.Net_Commission, c.Account_No, 
c.Bank_Name, c.Commission_Message
FROM comission c, employee e
WHERE c.Employee_Code = e.Profile_Id AND
c.Commission_Id='$id' LIMIT 1";
$query = mysqli_query($connection,$sql);
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
?>

