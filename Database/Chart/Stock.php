<?php
  // declare database variables
  // change to the information relevant
  // to your database
  header('Content-Type: application/json');
  include '../connection.php';
 
  $sqlQuery = "SELECT (Stock_Name) AS Stock_Name, 
  (Selling_Price) AS Selling_Price
  FROM     stock
  GROUP BY (Stock_Name)
  ORDER BY Stock_Name;";

  $result = mysqli_query($dbc,$sqlQuery);
  
  $data = array();
  foreach ($result as $row) {
      $data[] = $row;
  }
  
  mysqli_close($dbc);
  
  echo json_encode($data);
  ?>