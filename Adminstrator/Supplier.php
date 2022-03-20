<!--========== EMPLOYEES LEAVES ==========-->
<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
// Set the page title and include the HTML header:
$page_title = 'Supplier';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$ip = gethostbyname('www.google.com');

//Load Composer's autoloader
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

// Define the query:
$query = "SELECT *
FROM supplier
ORDER BY Supplier_Id ASC";
$supplier = @mysqli_query($dbc, $query);

// Count the number of returned rows:
$supplier_num = mysqli_num_rows($supplier);

$message = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 $path = '../Uploads/' . $_FILES["file"]["name"];
 move_uploaded_file($_FILES["file"]["tmp_name"], $path);
 $message = '
    <h3 align="left">Supplier Details</h3>
        <table border="0" width="80%" cellpadding="5" cellspacing="5">
            <tr>
                <td width="10%">Supplier Name: </td>
                <td width="50%">'.$_POST["Supplier_Name"].'</td>
            </tr>
            <tr>
                <td width="10%">Supplier Email: </td>
                <td width="50%">'.$_POST["Supplier_Email"].'</td>
            </tr>
            <tr>
                <td width="10%">Subject: </td>
                <td width="50%">'.$_POST["Subject"].'</td>
            </tr>
            <tr>
                <td width="10%">Message: </td>
                <td width="50%">'.$_POST["Message"].'</td>
            </tr>
            <tr>
                <td colspan="2">* Click an attachment below to see the details: </td>
            </tr>
        </table>
    ';
 


    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    //Server settings
    $mail->IsSMTP();        //Sets Mailer to send message using SMTP
    $mail->Host       = 'smtp.gmail.com';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
    $mail->Port       = 465;                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
    $mail->Username   = 'badamin16@gmail.com';                     //SMTP username
    $mail->Password   = 'KingAmin_77';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption

    //Recipients
    $mail->setFrom('badamin16@gmail.com', 'Badrul');
    $mail->addAddress('badamin16@gmail.com', 'Ali');     //Add a recipient

    //Content
    $mail->IsHTML(true);       //Sets message type to HTML
    $mail->AddAttachment($path);     //Adds an attachment from a path on the filesystem
    $mail->Subject = 'Stock Pruchase from BurgerByte';    //Sets the Subject of the message
    $mail->Body = $message;       //An HTML or plain text message body

    if($mail->Send())        //Send an Email. Return true on success or false on error
    {
        $message = '<div class="alert alert-success">Application Successfully Submitted</div>';
        unlink($path);
    }
    else
    {
        $message = '<div class="alert alert-danger">There is an Error</div>';
    }
}

?>

<div class='main-panel'>
    <div class='content-wrapper'>
        <div class='row'>
            <div class='col-md-12 grid-margin stretch-card'>
                <div class='card'>
                    <div class='card-body'>
                        <p class='card-title'>Manage Supplier</p>
                        <h4>There are currently <?php echo "$supplier_num" ?> <b>Suppliers </b>
                            Registration for</h4>
                        <p class='card-description'>
                            Supplier List <code>Manage</code>
                            <?php print_r($message); ?>
                        <form id="frmContact" action="Supplier.php" method="post" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Supplier Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="Supplier_Name" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Supplier Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="Supplier_Email" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Subject</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="Subject" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Attachment</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Message</label>
                                    <div class="col-sm-9">
                                        <textarea name="Message" class="form-control" cols="60" rows="6"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <input type="submit" name="submit" value="Submit" class="btn btn-primary mr-2"  />
                                    <button class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include '../partials/Footer.html';?>