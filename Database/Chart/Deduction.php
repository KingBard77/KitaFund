<?php
  // declare database variables
  // change to the information relevant
  // to your database
  header('Content-Type: application/json');
  include '../connection.php';

  session_start();

  $emp_code = $_SESSION["Employee_Code"];
 
  $sqlQuery = "SELECT MONTHNAME(c.Commission_Date) AS month, 
  SUM(c.Deduction) AS Deduction
  FROM     comission c, employee e, profile p
  WHERE c.Employee_Code = e.Profile_Id 
  AND c.Employee_Code = p.Profile_Id
  AND e.Employee_Code ='$emp_code'
  GROUP BY MONTHNAME(c.Commission_Date)
  ORDER BY c.Commission_Date";

  $result = mysqli_query($dbc,$sqlQuery);
  
  $data = array();
  foreach ($result as $row) {
      $data[] = $row;
  }
  
  mysqli_close($dbc);
  
  echo json_encode($data);
  ?>