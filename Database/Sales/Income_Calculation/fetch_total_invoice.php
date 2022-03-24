<?php
include '../../config/db-config.php';
global $connection;

$data=array();

if (isset($_POST['date'])) {
    $date = $_POST['date'];

    $sql = "SELECT SUM(Total_Sales) AS Total_Sales
    FROM invoice
    WHERE DATE(Invoice_Date) = CAST('".$date."' AS DATE)";
    $query= mysqli_query($connection,$sql);
    if($query ==true){
        while ($row = mysqli_fetch_assoc($query))
        {
           $data['Total_Sales'] = $row['Total_Sales'] !=null ? $row['Total_Sales'] : 0;
        }
        $data['success'] = true;
    }
    else{
        $data['success'] = false;
    } 
}

echo json_encode($data);

?>