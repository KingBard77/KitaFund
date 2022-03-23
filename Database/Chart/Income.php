<?php
  // declare database variables
  // change to the information relevant
  // to your database
  header('Content-Type: application/json');
  include '../connection.php';
 
  $sqlQuery = "SELECT 
  MONTHNAME(Income_Date) AS Income_Date, 
  SUM(Net_Income) AS Net_Income
  FROM     income
  GROUP BY MONTHNAME(Income_Date)
  ORDER BY Income_Date";


    $result = mysqli_query($dbc,$sqlQuery);

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }

    mysqli_close($dbc);

    echo json_encode($data);
?>



  