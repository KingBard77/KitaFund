<!--========== ONWER RECEIPT PURCHAse  ==========-->
<?php 
include '../../config/db-config.php';
global $connection;

$purchase_id = $_GET['id'];
$customer_details = '';  
$order_details = '';  
$total = 0;  
$query = '  
SELECT * FROM purchase  
INNER JOIN purchase_details  
ON purchase_details.purchase_id = purchase.purchase_id  
INNER JOIN profile  
ON profile.Profile_Id = purchase.Owner_Code  
iNNER JOIN owner
ON owner.Profile_Id = purchase.Owner_Code
WHERE purchase.purchase_id = "'.$purchase_id .'" 
';  
$result = mysqli_query($connection, $query);  
while($row = mysqli_fetch_array($result))  
{  
    $order_details .= "  
            <tr>  
                <td>".$row["Description"]."</td>  
                <td class='text-center'>".$row["Quantity"]."</td>  
                <td class='text-center'>RM ".$row["Total_Expenses"]."</td>  
                <td>RM ".number_format($row["Quantity"] * $row["Total_Expenses"], 2)."</td>  
            </tr>  
    ";  
    $total = $total + ($row["Quantity"] * $row["Total_Expenses"]);  
}  
echo '  
<div class="table-responsive" id="GFG">  
    <table class="table">    
        <tr>  
            <td><label><b>Stock Purchase Details</b></label></td>  
        </tr>  
        <tr>  
            <td>  
                <table class="table table-bordered" id="GFG">  
                        <tr>  
                            <th width="50%">Stock Name</th>  
                            <th class="text-center" width="15%">Quantity</th>  
                            <th class="text-center" width="15%">Price (RM)</th>  
                            <th width="20%">SubTotal (RM)</th>  
                        </tr>  
                        '.$order_details.'  
                        <tr>  
                            <td colspan="3" align="right"><label><b>TOTAL EXPENSES</b></label></td>    
                            <td><b> RM '.number_format($total, 2).' </b></td>  
                        </tr>  
                </table>  
            </td>  
        </tr>  
    </table> 
</div> 
';  

?>