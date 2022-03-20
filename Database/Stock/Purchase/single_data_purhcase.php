<?php 
include '../../config/db-config.php';
global $connection;

$id = $_POST['id'];
$sql = "

SELECT *, 
GROUP_CONCAT( DISTINCT purchase_details.Description) as 'Descriptions'  ,
ROUND(SUM(purchase_details.Total_Expenses),2) as 'TotalExpenses',
GROUP_CONCAT( purchase_details.Quantity) as 'Quantities'  
FROM purchase_details
INNER JOIN purchase
ON purchase_details.purchase_id = purchase.purchase_id
INNER JOIN profile  
ON profile.Profile_Id = purchase.Owner_Code  
iNNER JOIN owner
ON owner.Profile_Id = purchase.Owner_Code
WHERE purchase_details.Purchase_Id='$id'
GROUP BY purchase_details.Purchase_Id LIMIT 1";

$query = mysqli_query($connection,$sql);
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
?>
