<!--========== EMPLOYEES PROFILE VIEW ==========-->
<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
// Set the page title and include the HTML header:
$page_title = 'Employee Peofile';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';

// Check for a valid user ID, through GET or POST:
if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) { // From view_users.php
    $id = $_GET['id'];
} elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) { // Form submission.
    $id = $_POST['id'];
} else { // No valid ID, kill the script.
    echo '
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                        <p class="alert-heading"><h1>Supplier View</h1></p>
                        <p><b>Error</b></p>
                        <hr>
                        <p class="mb-0">This page has been accessed in error <br />
                        <b>Supplier View</b> are currently <b>NOT</b> registered.</p>
                    </div>
                <a class="btn btn-light" href="Supplier.php"><i class="ti-home mr-2"></i>Back to Supplier</a>                        
            </div>
        </div>
    </div>';
    include '../partials/Footer.html';
    exit();
}

// Retrieve the user's information:
$query = "SELECT *
FROM supplier
WHERE Supplier_Id = $id";
$supplier = mysqli_query($dbc, $query);

if (mysqli_num_rows($supplier) == 1) { // Valid user ID, show the form.

    // Get the user's information:
    $row = mysqli_fetch_array($supplier, MYSQLI_NUM); //MYSQLI_ASSOC
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class='row'>
            <div class='col-md-12 grid-margin stretch-card'>
                <div class='card'>
                    <div class='card-body'>
                        <div class="email-wrapper wrapper">
                            <div class="row align-items-stretch">
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

                                    <div class="message-body">
                                        <div class="sender-details">
                                            <img class="img-sm rounded-circle me-3"
                                                src="../../../../images/faces/face11.jpg" alt="">
                                            <div class="details">
                                                <p class="msg-subject">
                                                    <?php echo $row[3];?>
                                                </p>
                                                <p class="sender-email">
                                                    <?php echo $row[1];?>
                                                    <a href="#"><?php echo $row[2];?></a>
                                                    &nbsp;<i class="ti-user"></i>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="message-content">
                                            <p><?php echo $row[4];?></p>
                                            <p><br><br>Regards,<br>Sarah Graves</p>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
} else { // Not a valid user ID.
    echo '
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                        <p class="alert-heading"><h1>Employee Profile</h1></p>
                        <p><b>Error</b></p>
                        <hr>
                        <p class="mb-0">This page has been accessed in error <br />
                        <b>Owner Profolio</b> are currently <b>NOT</b> registered.</p>
                    </div>
                <a class="btn btn-light" href="Employees.php"><i class="ti-home mr-2"></i>Back to Employee</a>
            </div>
        </div>';
}

mysqli_close($dbc);
?>
        <script>
        function goBack() {
            window.history.back();
        }
        </script>
        <?php include '../partials/Footer.html';?>
        <!-- Custom js for this page-->
        <script src="../vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
        <script src="../js/profile-demo.js"></script>
        <!-- End custom js for this page-->