<!--========== CHECK LOGIN OWNER ==========-->
<?php 
// This page processes the login form submission.
// The script now uses sessions.

// Check if the form has been submitted:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Need two helper files:
        require ('../Login/login_functions.inc.php');
        require ('../Database/Connection.php');
            
        // Check the login:
        list ($check, $data) = check_login_owner($dbc, $_REQUEST['Username'], $_REQUEST['Password']);
        
        if ($check) { // OK!
            
            // Set the session data:
            session_start();
            $_SESSION['Profile_Id'] = $data['Profile_Id'];
            $_SESSION['Username'] = $data['Username'];
            
            // Redirect:
            redirect_user('DashBoard.php');
                
        } else { // Unsuccessful!
    
            // Assign $data to $errors for login_page.inc.php:
            $errors = $data;
        }
            
        mysqli_close($dbc); // Close the database connection.
    
    } // End of the main submit conditional.
    
    // Create the page:
    include ('../Login/login_page.inc.owner.php');
?>