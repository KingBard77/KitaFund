<?php
  // declare database variables
  // change to the information relevant
  // to your database
  header('Content-Type: application/json');
  include '../connection.php';
 
  $sqlQuery = "SELECT MONTHNAME(Sales_Date) AS month, SUM(SubTotal) AS sales
  FROM     sales
  GROUP BY MONTHNAME(Sales_Date)
  ORDER BY Sales_Date";

  $result = mysqli_query($dbc,$sqlQuery);
  
  $data = array();
  foreach ($result as $row) {
      $data[] = $row;
  }
  
  mysqli_close($dbc);
  
  echo json_encode($data);
  ?>