<?php 
include '../../../config/db-config.php';
global $connection;

$id = $_POST['id'];
$sql = "

SELECT *, 
GROUP_CONCAT( DISTINCT ordering_details.Description) as 'Descriptions'  ,
ROUND(SUM(ordering_details.Total_Expenses),2) as 'TotalExpenses',
GROUP_CONCAT( ordering_details.Quantity) as 'Quantities'  
FROM ordering_details
INNER JOIN ordering
ON ordering_details.order_id = ordering.order_id 
INNER JOIN profile  
ON profile.Profile_Id = ordering.Employee_Code  
iNNER JOIN employee
ON employee.Profile_Id = ordering.Employee_Code
WHERE ordering_details.Order_Id='$id'
GROUP BY ordering_details.Order_Id LIMIT 1";

$query = mysqli_query($connection,$sql);
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
?>
