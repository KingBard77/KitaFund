<?php
  // declare database variables
  // change to the information relevant
  // to your database
  header('Content-Type: application/json');
  include '../connection.php';
 
  $sqlQuery = "SELECT MONTHNAME(volunteer_date) AS month, 
  SUM(volunteer_remark) AS volunteer_remark
  FROM     volunteer
  GROUP BY MONTHNAME(volunteer_date)
  ORDER BY volunteer_date";

  $result = mysqli_query($dbc,$sqlQuery);
  
  $data = array();
  foreach ($result as $row) {
      $data[] = $row;
  }
  
  mysqli_close($dbc);
  
  echo json_encode($data);
  ?>