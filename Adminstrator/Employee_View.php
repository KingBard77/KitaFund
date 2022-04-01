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
                        <p class="alert-heading"><h1>Employee View</h1></p>
                        <p><b>Error</b></p>
                        <hr>
                        <p class="mb-0">This page has been accessed in error <br />
                        <b>Owner Profolio</b> are currently <b>NOT</b> registered.</p>
                    </div>
                <a class="btn btn-light" href="Employee.php"><i class="ti-home mr-2"></i>Back to Employee</a>                        
            </div>
        </div>
    </div>';
    include '../partials/Footer.html';
    exit();
}

// Retrieve the user's information:
$query = "SELECT p.Profile_Id, p.Image_Name, e.Employee_Code, p.Username, p.First_Name, p.Last_Name, p.Email,
p.Password, p.Phone, p.Gender, p.Address, p.City, p.State, p.Postal_Code, p.Country, p.DOB, p.Merital_Status,
p.Nationality, p.Identity_No, p.Typhoid, p.Vaccination, p.Joining_Date
FROM employee e, profile p
WHERE p.Profile_Id = $id
AND e.Profile_Id = p.Profile_Id";
$employee = mysqli_query($dbc, $query);

if (mysqli_num_rows($employee) == 1) { // Valid user ID, show the form.

    // Get the user's information:
    $row = mysqli_fetch_array($employee, MYSQLI_NUM); //MYSQLI_ASSOC
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="border-bottom text-center pb-4">
                                    <?php
                                        $image = $row[1];
                                        $image_src = "../Images/Employee_Image/" . $image;
                                    ?>
                                    <img src="<?php echo $image_src; ?>" alt="Employee Image"
                                        class="img-lg rounded-circle mb-3" />
                                    <div class="mb-3">
                                        <h3><?php echo $row[4];?> <?php echo $row[5];?> </h3>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <h5 class="mb-0 me-2 text-muted">Employee &nbsp;&nbsp;</h5>
                                            <select id="profile-rating" name="rating" autocomplete="off">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <p class="w-75 mx-auto mb-3"><b>Hello!</b> My Name is <b><?php echo $row[3];?></b>.
                                        This is my
                                        profile page.
                                        You can see the progress I've made with your work and manage your projects or
                                        assigned tasks </p>
                                </div>
                                <div class="border-bottom py-4">
                                    <p>Skills</p>
                                    <div class="col text-center">
                                        <label class="badge badge-outline-dark">Chef</label>
                                        <label class="badge badge-outline-dark">Cashier</label>
                                        <label class="badge badge-outline-dark">Store Leader</label>
                                        <label class="badge badge-outline-dark">Stock Management</label>
                                        <label class="badge badge-outline-dark">Marketing</label>
                                    </div>
                                </div>
                                <div class="border-bottom py-4">
                                    <p>Works Performance</p>
                                    <div class="d-flex mb-3">
                                        <div class="progress progress-md flex-grow">
                                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="55"
                                                style="width: 55%" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <p>Task Completed</p>
                                    <div class="d-flex">
                                        <div class="progress progress-md flex-grow">
                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="75"
                                                style="width: 75%" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-4">
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Status
                                        </span>
                                        <span class="float-right text-muted">
                                            <label class="badge badge-success">Active</label>
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Phone
                                        </span>
                                        <span class="float-right text-muted">
                                            +6<?php echo $row[8]; ?>
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Email
                                        </span>
                                        <span class="float-right text-muted">
                                            <?php echo $row[6]; ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-8 grid-margin">
                                <h5>Profile Information</h5>
                                <hr>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <!--========== View Employee Code ==========-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Employee Code</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="Employee_Code"
                                                            value="<?php echo $row[2]; ?> " disabled />
                                                    </div>
                                                </div>
                                            </div>

                                            <!--========== View Employee Username ==========-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Username</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">@</span>
                                                            </div>
                                                            <input type="text" class="form-control" name="Username"
                                                                value="<?php echo $row[3]; ?> " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!--========== View Employee Gender ==========-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Gender</label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="Gender" id="Male" value="male"
                                                                    <?php if($row[9]=="male"){ echo "checked";}?> />
                                                                Male
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="Gender" id="Female" value="female"
                                                                    <?php if($row[9]=="female"){ echo "checked";}?> />
                                                                Female
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--========== View Employee Address ==========-->
                                        <p class="card-description">
                                            Address
                                        </p>
                                        <div class="row">
                                            <!--========== View Employee Address ==========-->
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Street Address </label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" name="Address"
                                                            value="<?php echo $row[10]; ?> " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!--========== View Employee State ==========-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">State</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="State">
                                                            <?php
                                                            $states = array("Perlis", "Selangor", "Perak", "Pulau Pinang", "Melaka", "Johor", "Kedah", "Sabah", "Sarawak", "Kelantan", "Terengganu", "N.Sembilan");
                                                                foreach ($states as $value) {
                                                                    if ($row[12] == $value) { // creating sticky
                                                                        echo "<option value='" . $row[12] . "' selected>" . $row[12] . "</option>";
                                                                    } else {
                                                                        echo "<option value=\"$value\">$value</option>\n";
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--========== View Employee  Postal Code ==========-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Postcode</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="Postal_Code"
                                                            value="<?php echo $row[13]; ?> " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!--========== View Employee City ==========-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">City</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="City"
                                                            value="<?php echo $row[11]; ?> " />
                                                    </div>
                                                </div>
                                            </div>
                                            <!--========== View Employee  Country ==========-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Country</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="Country"
                                                            value="<?php echo $row[14]; ?> " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!--========== View Employee DOB ==========-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Date of Birth</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="DOB"
                                                            id="from-datepicker" value="<?php echo $row[15]; ?> " />
                                                    </div>
                                                </div>
                                            </div>
                                            <!--========== View Employee  Nationality  ==========-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Nationaility</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="Nationality">
                                                            <?php
                                                            $Nationality = array('Nationality', 'Non-Nationality');
                                                                foreach ($Nationality as $value) {
                                                                    if ($row[17] == $value) { // creating sticky
                                                                        echo "<option value='" . $row[17] . "' selected>" . $row[17] . "</option>";
                                                                    } else {
                                                                        echo "<option value=\"$value\">$value</option>\n";
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <!--========== View Employee Merital Status ==========-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Merital Status</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="Merital_Status">
                                                            <?php
                                                            $Merital_Status = array('Married', 'Single', 'Widowed', 'Dicvorced');
                                                                foreach ($Merital_Status as $value) {
                                                                    if ($row[16] == $value) { // creating sticky
                                                                        echo "<option value='" . $row[16] . "' selected>" . $row[16] . "</option>";
                                                                    } else {
                                                                        echo "<option value=\"$value\">$value</option>\n";
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--========== View Employee  Identity_No  ==========-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Identity No</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="Identity_No"
                                                            value="<?php echo $row[18]; ?> " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!--========== View Employee Vaccination ==========-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Vaccination</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="Vaccination">
                                                            <?php
                                                            $Vaccination = array('None', 'Partial Vaccination', 'Fully Vaccination');
                                                                foreach ($Vaccination as $value) {
                                                                    if ($row[20] == $value) { // creating sticky
                                                                        echo "<option value='" . $row[20] . "' selected>" . $row[20] . "</option>";
                                                                    } else {
                                                                        echo "<option value=\"$value\">$value</option>\n";
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--========== View Employee Typhoid ==========-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Typhoid</label>
                                                    <div class="col-sm-4">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="Typhoid" id="Yes" value="Yes"
                                                                    <?php if($row[19]=="Yes"){ echo "checked";}?> />
                                                                Yes
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="Typhoid" id="No" value="No"
                                                                    <?php if($row[19]=="No"){ echo "checked";}?> />
                                                                Nope
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" align="right">
                                            <button onclick="window.print()" class="btn btn-primary mr-2"><i
                                                    class="ti-printer me-1"></i> Print</a></button>
                                            <button onclick="goBack()" class="btn btn-light">Back</button>
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