<?php
// Set the page title and include the HTML header:
$page_title = 'Contact';
include 'partials/Header.html';
?>

<!-- Page Header Start -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Contact Us</h2>
            </div>
            <div class="col-12">
                <a href="">Home</a>
                <a href="">Contact</a>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<?php
require ('Database/Connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.

    if (empty($_POST['contact_name'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Contact Name.</b>';
    } else {
        $contact_name = trim($_POST['contact_name']);
    }

    if (empty($_POST['contact_email'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Contact Email.</b>';
    } else {
        $contact_email = trim($_POST['contact_email']);
    }

    if (empty($_POST['contact_subject'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Contact Subject.</b>';
    } else {
        $contact_subject = trim($_POST['contact_subject']);
    }

    if (empty($_POST['contact_message'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Contact Message.</b>';
    } else {
        $contact_message = trim($_POST['contact_message']);
    }

    if (empty($errors)) { // If everything's OK.


        // Make the query
        $query = "INSERT INTO contact (contact_name, contact_email, contact_subject, contact_message)
        VALUES ('$contact_name', '$contact_email', '$contact_subject', '$contact_message')";
        $result = mysqli_query($dbc, $query); // Run the query.

        if ($result) { // If it ran OK.
            // Print a message:
            echo '
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                <p class="alert-heading"><h1>Insert Successfully</h1></p>
                                <p><b>Thank You</b> </p>
                                <hr>
                                <p class="mb-0">You are now add a new Contact</p>
                            </div>
                            <a class="btn btn-light" href="contact.php"><i class="ti-home mr-2"></i>Back to Contact Page</a>
                        </div>
                    </div>
                </div>';

        } else { // If it did not run OK.
            // Public message:
            echo '
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card-body">
                            <div class="alert alert-danger" role="alert">
                                <p class="alert-heading"><h1>System Error</h1></p>
                                <p><b>Thank You</b> </p>
                                <hr>
                                <p class="mb-0">You could not be registered due to a system error. We apologize for any inconvenience.</p><br/>';
                                // Debugging message:
                                echo '<p style="color:black;"><b>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</b></p>
                            </div>
                            <a class="btn btn-light" href="contact.php"><i class="ti-home mr-2"></i>Back to Contact Page</a>                        
                        </div>
                    </div>
                </div>';
        } // End of if ($r) IF.

        mysqli_close($dbc); // Close the database connection.
        // Include the footer and quit the script:
        include 'partials/Footer.php';
        exit();
    } else { // Report the errors.
        echo '
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card-body">
                            <div class="alert alert-warning alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <h1><strong>Error!</strong> </h1>
                                <p class="mb-0">The following error(s) occurred:</p><br/>';
                                foreach ($errors as $msg) { // Print each error.
                                    echo " - $msg<br />\n";
                                }
                                echo '
                                </p><p class="mb-0">Please try again.</p><p><br /></p>
                            </div>
                            <a class="btn btn-light" href="contact.php"><i class="ti-home mr-2"></i>Back to Contact Page</a> 
                        </div>
                    </div>
                </div>';
    } // End of if (empty($errors)) IF.
    mysqli_close($dbc); // Close the database connection.
    include 'partials/Footer.php';
    exit();
}
?>
<!-- Contact Start -->
<div class="contact">
    <div class="container">
        <div class="section-header text-center">
            <p>Get In Touch</p>
            <h2>Contact for any query</h2>
        </div>
        <div class="contact-img">
            <img src="Images/Index/Contact.jpg" alt="Image">
        </div>
        <div class="contact-form">
            <div id="success"></div>
            <form action="contact.php" method="post">
                <div class="control-group">
                    <input type="text" class="form-control" id="name" placeholder="Your Name" required="required"
                        data-validation-required-message="Please enter your name" name="contact_name" />
                    <p class="help-block text-danger"></p>
                </div>
                <div class="control-group">
                    <input type="email" class="form-control" id="email" placeholder="Your Email" required="required"
                        data-validation-required-message="Please enter your email" name="contact_email"/>
                    <p class="help-block text-danger"></p>
                </div>
                <div class="control-group">
                    <select class="form-control" id="subject" name="contact_subject" 
                        data-validation-required-message="Please enter a subject" required="required">
                        <option value="">- Please Select Contact Subject -</option>
                        <option value="Suggestion">Suggestion</option>
                        <option value="Enquiry">Enquiry</option>
                        <option value="Complaint">Complaint</option>
                        <option value="Service Request">Service Requests</option>
                    </select>
                    <p class="help-block text-danger"></p>
                </div>
                <div class="control-group">
                    <textarea class="form-control" id="message" placeholder="Message" required="required"
                        data-validation-required-message="Please enter your message" name="contact_message"></textarea>
                    <p class="help-block text-danger"></p>
                </div>
                <div>
                    <button type="submit" class="btn btn-custom" type="submit" id="sendMessageButton">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Contact End -->

<!-- Footer Start -->
<?php
// Set the page title and include the HTML header:
include 'partials/Footer.php';
?>
<!-- Footer End -->

</body>

</html>