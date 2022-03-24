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
    $errors = array(); // Initialize an error array.

    $Supplier_Name = $_POST['Supplier_Name'];
    $Supplier_Email = $_POST['Supplier_Email'];
    $Subject = $_POST['Subject'];
    $Message = $_POST['Message'];

    $sql = "INSERT INTO `supplier` ( `Supplier_Name`,`Supplier_Email`, `Subject`, `Message`)
    values ('$Supplier_Name',  '$Supplier_Email', '$Subject', '$Message')";

    $query= mysqli_query($dbc,$sql);

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
            </table>';
 


    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    //Server settings
    $mail->IsSMTP();                                    //Sets Mailer to send message using SMTP
    $mail->Host       = 'smtp.gmail.com';               //Sets the SMTP hosts of your Email hosting, this for Godaddy
    $mail->Port       = 465;                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->SMTPAuth = true;                             //Sets SMTP authentication. Utilizes the Username and Password variables
    $mail->Username   = 'BurgerByte1998@gmail.com';     //SMTP username
    $mail->Password   = 'Adminstrator_1998';            //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    //Enable implicit TLS encryption

    //Recipients
    $mail->setFrom('BurgerByte1998@gmail.com', 'Badrul');
    $mail->addAddress('BurgerByte1998@gmail.com', 'Ali');       //Add a recipient

    //Content
    $mail->IsHTML(true);                                        //Sets message type to HTML
    $mail->AddAttachment($path);                                //Adds an attachment from a path on the filesystem
    $mail->Subject = 'Stock Pruchase from BurgerByte.Co';       //Sets the Subject of the message
    $mail->Body = $message;                                     //An HTML or plain text message body

    if($mail->Send())                                           //Send an Email. Return true on success or false on error
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

<div class="main-panel">
    <div class="content-wrapper">
        <div class='row'>
            <div class='col-md-12 grid-margin stretch-card'>
                <div class='card'>
                    <div class='card-body'>
                        <p class='card-title'>Manage Supplier</p>
                        <h4>There are currently <b><?php echo "$supplier_num" ?> Suppliers </b>
                            Registration for</h4>
                        <p class='card-description'>
                            Supplier List <code>Manage</code>
                            <?php print_r($message); ?>

                            <!-- SEND AN EMAIL -->
                        <div id="Bar" class="collapse in">
                            <form class="forms-sample" action="Supplier.php" method="post"
                                enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Supplier Name</label>
                                        <div class="col-sm-9">
                                            <select type="text" name="Supplier_Name" class="form-control" required>
                                                <option value="">---- Select Supplier Name ----</option>
                                                <option value="Season's Enterprise">Season's Enterprise</option>
                                                <option value="Rahman Bandar Universiti">Rahman Bandar Universiti
                                                </option>
                                                <option value="Al Khaleed Sdn Bhd">Al Khaleed Sdn Bhd</option>
                                                <option value="Melbourne Retail">Melbourne Retail</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Supplier Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="Supplier_Email" class="form-control"
                                                placeholder="Supplier Email Eg:-Azman@BurgerByte" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Subject</label>
                                        <div class="col-sm-9">
                                            <select type="text" name="Subject" class="form-control" required>
                                                <option value="">---- Select Subject----</option>
                                                <option value="Raw Material Ordering">Raw Material Ordering</option>
                                                <option value="Dry Material Ordering">Dry Material Ordering</option>
                                                <option value="Purchase Stock">Purchase Stock</option>
                                                <option value="Purchase Cooking Utensils">Purchase Cooking Utensils
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Attachment</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="file" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Message</label>
                                        <div class="col-sm-9">
                                            <textarea name="Message" class="form-control" cols="60" rows="6"
                                                placeholder="Write something here about the purchase Eg:- I pick up the product at 3.00 pm "
                                                required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <input type="submit" name="submit" value="Submit"
                                            class="btn btn-primary mr-2" />
                                        <button class="btn btn-light">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-12 grid-margin stretch-card'>
                <div class='card'>
                    <div class='card-body'>
                        <div class="email-wrapper wrapper">
                            <div class="row align-items-stretch">
                                <div class="mail-sidebar d-none d-lg-block col-md-2 pt-3 bg-white">
                                    <!-- SECTION 1 -->
                                    <div class="menu-bar">
                                        <ul class="menu-items">
                                            <li class="compose mb-3">
                                                <button href="#Bar" style="float: right;" data-toggle="collapse"
                                                    class="btn btn-primary btn-block">Compose
                                                </button>
                                            </li>
                                            <li class="active"><a href="#"><i class="ti-email"></i> Inbox</a><span
                                                    class="badge badge-pill badge-success"><?php echo "$supplier_num" ?></span>
                                            </li>
                                            <li><a href="#"><i class="ti-share"></i> Sent</a></li>
                                            <li><a href="#"><i class="ti-file"></i> Draft</a><span
                                                    class="badge badge-pill badge-warning"><?php echo "$supplier_num" ?></span>
                                            </li>
                                            <li><a href="#"><i class="ti-upload"></i> Outbox</a><span
                                                    class="badge badge-pill badge-danger"><?php echo "$supplier_num" ?></span>
                                            </li>
                                            <li><a href="#"><i class="ti-star"></i> Starred</a></li>
                                            <li><a href="#"><i class="ti-trash"></i> Trash</a></li>
                                        </ul>
                                        <div class="wrapper">
                                            <div
                                                class="online-status d-flex justify-content-between align-items-center">
                                                <p class="chat">Supplier List</p> <span
                                                    class="status offline online"></span>
                                            </div>
                                        </div>
                                        <ul class="profile-list">
                                            <li class="profile-list-item"> <a href="#"> <span class="pro-pic"><img
                                                            src="../Images/Supplier/Rahman.png" alt=""></span>
                                                    <div class="user">
                                                        <p class="u-name">Rahman Bandar Universiti</p>
                                                        <p class="u-designation">Seri Iskandar</p>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="profile-list-item"> <a href="#"> <span class="pro-pic"><img
                                                            src="../Images/Supplier/AlKhaleed.png" alt=""></span>
                                                    <div class="user">
                                                        <p class="u-name">Al Khaleed Sdn Bhd</p>
                                                        <p class="u-designation">Ipoh</p>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="profile-list-item"> <a href="#"> <span class="pro-pic"><img
                                                            src="../Images/Supplier/PCK.png" alt=""></span>
                                                    <div class="user">
                                                        <p class="u-name">Season's Enterprise</p>
                                                        <p class="u-designation">Seri Iskandar</p>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="profile-list-item"> <a href="#"> <span class="pro-pic"><img
                                                            src="../Images/Supplier/KRM.png" alt=""></span>
                                                    <div class="user">
                                                        <p class="u-name">Melbourne Retail</p>
                                                        <p class="u-designation">Batu Gajah</p>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- SECTION 2 -->
                                <div class="mail-list-container col-md-3 pt-4 pb-4 border-right bg-white">
                                    <div class="border-bottom pb-4 mb-3 px-3">
                                        <div class="form-group">
                                            <input class="form-control w-100" type="search" placeholder="Search mail"
                                                id="Mail-rearch">
                                        </div>
                                    </div>
                                    <div class="menu-bar">
                                        <?php
                                        // Define the query:
                                        $query = "SELECT *
                                        FROM supplier
                                        ORDER BY Supplier_Id ASC";
                                        $supplier = @mysqli_query($dbc, $query);

                                        // Count the number of returned rows:
                                        $supplier_num = mysqli_num_rows($supplier);
                                        if(mysqli_num_rows($supplier) > 0)  
                                        {  
                                            while($row = mysqli_fetch_array($supplier))  
                                            {  
                                        ?>
                                        <div onclick="location.href='Supplier.php?id=<?php echo $row['Supplier_Id']; ?>';"
                                            style="cursor: pointer;" id="#Body-Email">
                                            <div class="mail-list">
                                                <div class="form-check"> <label class="form-check-label"> <input
                                                            type="checkbox" class="form-check-input"> </label>
                                                </div>
                                                <div class="content">
                                                    <p class="sender-name">
                                                        <?php echo $row["Supplier_Name"]; ?>
                                                    </p>
                                                    <p class="message_text">
                                                        <?php echo $row["Message"]; ?>.
                                                    </p>
                                                </div>
                                                <!--<a href="Supplier_View.php?id= <?php echo $row["Supplier_Id"]; ?>">See more</a>-->
                                                <div class="details">
                                                    <i class="ti-star favorite"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php  
                                            }  
                                        }  
                                        ?>
                                    </div>
                                </div>

                                <!-- SECTION 3 -->
                                <div class="mail-view d-none d-md-block col-md-9 col-lg-7 bg-white">
                                    <div class="row">
                                        <div class="col-md-12 mb-4 mt-4">
                                            <div class="btn-toolbar">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"><i
                                                            class="ti-share-alt text-primary me-1"></i> Reply</button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"><i
                                                            class="ti-share-alt text-primary me-1"></i>Reply
                                                        All</button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"><i
                                                            class="ti-share text-primary me-1"></i>Forward</button>
                                                </div>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"><i
                                                            class="ti-clip text-primary me-1"></i>Attach</button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"><i
                                                            class="ti-trash text-primary me-1"></i>Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="Body-Email">
                                        <?php
                                        $Supplier_Id = $_REQUEST['id'];
                                        // Retrieve the user's information:
                                        $query = "SELECT *
                                        FROM supplier
                                        WHERE Supplier_Id = $Supplier_Id ";
                                        $supplier = mysqli_query($dbc, $query);

                                        if (mysqli_num_rows($supplier) == 1) { // Valid user ID, show the form.

                                            // Get the user's information:
                                            $row = mysqli_fetch_array($supplier, MYSQLI_NUM); //MYSQLI_ASSOC
                                        ?>
                                        <div class="message-body">
                                            <div class="sender-details">
                                                <img class="img-sm rounded-circle me-3" src="../Images/Logo.png" alt="">
                                                &nbsp;
                                                &nbsp;
                                                <div class="details">
                                                    <p class="msg-subject">
                                                        <?php echo $row[3];?>
                                                    </p>
                                                    <p class="sender-email">
                                                        <?php echo $row[1];?> |
                                                        <a href="#"><?php echo $row[2];?></a>
                                                        &nbsp;<i class="ti-user"></i>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="message-content">
                                                <p><?php echo $row[4];?></p>
                                                <p><br><br>Regards,<br>BurgerByte.Co</p>
                                                <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i>*
                                                    Click an attachment below to see the details:</p>
                                            </div>
                                            <div class="attachments-sections">
                                                <ul>
                                                    <li>
                                                        <div class="thumb"><i class="ti-file"></i></div>
                                                        <div class="details">
                                                            <p class="file-name">Seminar Reports.pdf</p>
                                                            <div class="buttons">
                                                                <p class="file-size">678Kb</p>
                                                                <a href="#" class="view">View</a>
                                                                <a href="#" class="download">Download</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="thumb"><i class="ti-image"></i></div>
                                                        <div class="details">
                                                            <p class="file-name">Product Design.jpg</p>
                                                            <div class="buttons">
                                                                <p class="file-size">1.96Mb</p>
                                                                <a href="#" class="view">View</a>
                                                                <a href="#" class="download">Download</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php
                                        } else { // Not a valid user ID.
                                            echo 'NO DATA';
                                        }
                                        
                                        mysqli_close($dbc);?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
        </script>

        <!--========== INCLUDE FOOTER ==========-->
        <?php include '../partials/Footer.html';?>