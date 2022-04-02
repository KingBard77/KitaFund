<?php 
include '../config/db-config.php';
global $connection;

$id = $_POST['id'];
$sql = "SELECT p.Bank_Name, p.Account_No, c.Commission_Id, e.Employee_Code, c.Commission_Date, c.Commission_Status,
c.Basic_Commission, c.Earning_Total, c.Claiming, c.Deduction, c.Bonus, c.Net_Commission, c.Commission_Message
FROM comission c, employee e, profile p
WHERE c.Employee_Code = e.Profile_Id AND c.Employee_Code = p.Profile_Id AND
c.Commission_Id='$id' LIMIT 1";
$query = mysqli_query($connection,$sql);
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
?>

