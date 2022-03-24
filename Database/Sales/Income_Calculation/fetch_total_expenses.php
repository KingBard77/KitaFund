<?php
include '../../config/db-config.php';
global $connection;

$data=array();

if (isset($_POST['date'])) {
    $date = $_POST['date'];

    $sql = "SELECT SUM(purchase_details.Total_Expenses) AS Net_Expenses 
    FROM purchase_details, purchase
    WHERE DATE(Purchase_Date) = CAST('".$date."' AS DATE)";
    $query= mysqli_query($connection,$sql);
    if($query ==true){
        while ($row = mysqli_fetch_assoc($query))
        {
           $data['Net_Expenses'] = $row['Net_Expenses'] !=null ? $row['Net_Expenses'] : 0;
        }
        $data['success'] = true;
    }
    else{
        $data['success'] = false;
    } 
}

echo json_encode($data);

?>