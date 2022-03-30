<?php
require_once "../connection.php";

$id = $_POST['id'];
$sqlDelete = "DELETE FROM event WHERE id=".$id;

mysqli_query($dbc, $sqlDelete);
echo mysqli_affected_rows($dbc);

mysqli_close($dbc);
?>