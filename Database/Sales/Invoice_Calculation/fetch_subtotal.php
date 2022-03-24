<?php
include '../../config/db-config.php';
global $connection;
$data=array();
if (isset($_POST['date'])) {
    $date = $_POST['date'];

    $sql = "SELECT SUM(SubTotal) AS total FROM sales WHERE DATE(Sales_Date) = CAST('".$date."' AS DATE)";
    $query= mysqli_query($connection,$sql);
    if($query ==true){
        while ($row = mysqli_fetch_assoc($query))
        {
           $data['total'] = $row['total'] !=null ? $row['total'] : 0;
        }
        $data['success'] = true;
    }
    else{
        $data['success'] = false;
    } 
}

echo json_encode($data);

?>