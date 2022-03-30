<?php
    require_once "../connection.php";

    $json = array();
    $sqlQuery = "SELECT * FROM event ORDER BY id";

    $result = mysqli_query($dbc, $sqlQuery);
    $eventArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($eventArray, $row);
    }
    mysqli_free_result($result);

    mysqli_close($dbc);
    echo json_encode($eventArray);
?>