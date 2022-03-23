<?php
  // declare database variables
  // change to the information relevant
  // to your database
  header('Content-Type: application/json');
  include '../connection.php';
 
  $sqlQuery = "SELECT 
  MONTHNAME(Invoice_Date) AS Invoice_Date, 
  SUM(Overhead) AS Overhead,
  SUM(Total_Cash) AS Total_Cash,
  SUM(Total_Sales) AS Total_Sales
  FROM     invoice
  GROUP BY MONTHNAME(Invoice_Date)
  ORDER BY Invoice_Date";


    $result = mysqli_query($dbc,$sqlQuery);

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }

    mysqli_close($dbc);

    echo json_encode($data);
?>



  