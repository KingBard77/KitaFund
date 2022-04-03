<?php 
// This page defines two functions used by the login/logout process.

/* This function determines an absolute URL and redirects the user there.
 * The function takes one argument: the page to be redirected to.
 * The argument defaults to index.php.
 */
function redirect_user ($page = '../index.php') {

	// Start defining the URL...
	// URL is http:// plus the host name plus the current directory:
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	
	// Remove any trailing slashes:
	$url = rtrim($url, '/\\'); 
	
	// Add the page:
	$url .= '/' . $page;
	
	// Redirect the user:
	header("Location: $url");
	exit(); // Quit the script.

} // End of redirect_user() function.


function check_login_owner($dbc, $Username = '', $Password = '') {

	$errors = array(); // Initialize error array.

	// Validate the email address:
	if (empty($Username)) {
		$errors[] = '<b style="color:black;">You forgot to enter your <b> Username. </b>';
	} else {
		$Username = mysqli_real_escape_string($dbc, trim($Username));
	}

	// Validate the password:
	if (empty($Password)) {
		$errors[] = '<b style="color:black;">You forgot to enter your <b> Password. </b>';
	} else {
		$Password = mysqli_real_escape_string($dbc, trim($Password)); 
	}

	if (empty($errors)) { // If everything's OK.

		// Retrieve the user_id and first_name for that email/password combination:
		$query = "SELECT Profile_Id, Username 
		FROM profile 
		WHERE Username='$Username' AND Password=('$Password')";		
		$result = @mysqli_query ($dbc, $query); // Run the query.
		
		// Check the result:
		if (mysqli_num_rows($result) == 1) {

			// Fetch the record:
			$row = mysqli_fetch_array ($result, MYSQLI_ASSOC);
	
			// Return true and the record:
			return array(true, $row);
			
		} else { // Not a match!
			$errors[] = '<b style="color:black;">The Username and Password entered do not match those on file.</b>';
		}
		
	} // End of empty($errors) IF.
	
	// Return false and the errors:
	return array(false, $errors);

} // End of check_login() function.

//This is checking LOGIN for ADMIN
function check_login_employee($dbc, $Employee_Code = '', $Password = '') {

   $errors = array(); // Initialize error array.

   // Validate the username:
   if (empty($Employee_Code)) {
	   $errors[] = '<b style="color:black;">You forgot to enter your <b> Employee Code.</b>';
   } else {
	   $Employee_Code = mysqli_real_escape_string($dbc, trim($Employee_Code)); 
   }

   // Validate the password:
   if (empty($Password )) {
	   $errors[] = '<b style="color:black;">You forgot to enter your <b>  Password.</b>';
   } else {
	   $Password = mysqli_real_escape_string($dbc, trim($Password ));
   }

   if (empty($errors)) { // If everything's OK.

	   // Retrieve the user_id and first_name for that email/password combination:
		$query = "SELECT p.Profile_Id, e.Employee_Code 
		FROM employee e, profile p 
		WHERE e.Employee_Code='$Employee_Code' AND p.Password=('$Password') 
		AND e.Profile_Id = p.Profile_Id";		
	   $result = @mysqli_query ($dbc, $query); // Run the query.
	   
	   // Check the result:
	   if (mysqli_num_rows($result) == 1) {

		   // Fetch the record:
		   $row = mysqli_fetch_array ($result, MYSQLI_ASSOC);
   
		   // Return true and the record:
		   return array(true, $row);
		   
	   } else { // Not a match!
		   $errors[] = '<b style="color:black;">The Employee Code and Password entered do not match those on file.</b>';
	   }
	   
   } // End of empty($errors) IF.
   
   // Return false and the errors:
   return array(false, $errors);

} // End of check_login() function.