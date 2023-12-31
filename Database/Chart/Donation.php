<?php
  // declare database variables
  // change to the information relevant
  // to your database
  header('Content-Type: application/json');
  include '../connection.php';
 
  $sqlQuery = "SELECT MONTHNAME(donator_date) AS month, 
  SUM(amount) AS amount
  FROM     donator
  GROUP BY MONTHNAME(donator_date)
  ORDER BY donator_date";

  $result = mysqli_query($dbc,$sqlQuery);
  
  $data = array();
  foreach ($result as $row) {
      $data[] = $row;
  }
  
  mysqli_close($dbc);
  
  echo json_encode($data);
  ?>