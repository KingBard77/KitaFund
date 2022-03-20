<?php
include '../../config/db-config.php';
global $connection;

$id = $_POST['id'];
$sql = "DELETE FROM sales WHERE Sales_Id='$id'";
$delQuery = mysqli_query($connection, $sql);
if ($delQuery == true) {
    $data = array(
        'status' => 'success',

    );

    echo json_encode($data);
} else {
    $data = array(
        'status' => 'failed',

    );

    echo json_encode($data);
}
