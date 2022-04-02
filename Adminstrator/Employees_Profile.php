<!--========== EMPLOYEES PROFILE ==========-->
<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
// Set the page title and include the HTML header:
$page_title = 'Employee Profile';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';

$sql = "SELECT * FROM employee";
$all_profile = mysqli_query($dbc, $sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.

    if (empty($_POST['First_Name'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee First Name.</b>';
    } else {
        $First_Name = trim($_POST['First_Name']);
    }

    if (empty($_POST['Last_Name'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Last Name.</b>';
    } else {
        $Last_Name = trim($_POST['Last_Name']);
    }

    if (empty($_POST['Email'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Email.</b>';
    } else {
        $Email = trim($_POST['Email']);
    }

    if (empty($_POST['Phone'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Phone.</b>';
    } else {
        $Phone = trim($_POST['Phone']);
    }

    if (empty($_POST['Password'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Password.</b>';
    } else {
        $Password = trim($_POST['Password']);
    }
    // Check for a Username:
    if (empty($_POST['Username'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Username.</b>';
    } else {
        $Username = mysqli_real_escape_string($dbc, trim($_POST['Username']));
    }
    // Check for a Gender:
    if (empty($_POST['Gender'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Gender.</b>';
    } else {
        $Gender = mysqli_real_escape_string($dbc, trim($_POST['Gender']));
    }
    // Check for a DOB:
    if (empty($_POST['DOB'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Date of Birth.</b>';
    } else {
        $DOB = mysqli_real_escape_string($dbc, trim($_POST['DOB']));
    }
    // Check for a Address:
    if (empty($_POST['Address'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Address.</b>';
    } else {
        $Address = mysqli_real_escape_string($dbc, trim($_POST['Address']));
    }
    // Check for a City:
    if (empty($_POST['City'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee City.</b>';
    } else {
        $City = mysqli_real_escape_string($dbc, trim($_POST['City']));
    }
    // Check for a State:
    if (empty($_POST['State'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee State.</b>';
    } else {
        $State = mysqli_real_escape_string($dbc, trim($_POST['State']));
    }
    // Check for a Postal Code:
    if (empty($_POST['Postal_Code'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Postal Code.</b>';
    } else {
        $Postal_Code = mysqli_real_escape_string($dbc, trim($_POST['Postal_Code']));
    }
    // Check for a Country:
    if (empty($_POST['Country'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Country.</b>';
    } else {
        $Country = mysqli_real_escape_string($dbc, trim($_POST['Country']));
    }
    // Check for a Bank Name:
    if (empty($_POST['Bank_Name'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Bank Name.</b>';
    } else {
        $Bank_Name = mysqli_real_escape_string($dbc, trim($_POST['Bank_Name']));
    }
    // Check for a Account No:
    if (empty($_POST['Account_No'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Account No.</b>';
    } else {
        $Account_No = mysqli_real_escape_string($dbc, trim($_POST['Account_No']));
    }
    // Check for a Merital Status:
    if (empty($_POST['Merital_Status'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Merital Status.</b>';
    } else {
        $Merital_Status = mysqli_real_escape_string($dbc, trim($_POST['Merital_Status']));
    }
    // Check for a Nationality:
    if (empty($_POST['Nationality'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Nationality.</b>';
    } else {
        $Nationality = mysqli_real_escape_string($dbc, trim($_POST['Nationality']));
    }
    // Check for a Identity No:
    if (empty($_POST['Identity_No'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Identity Number.</b>';
    } else {
        $Identity_No = mysqli_real_escape_string($dbc, trim($_POST['Identity_No']));
    }
    // Check for a Typhoid:
    if (empty($_POST['Typhoid'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Typhoid.</b>';
    } else {
        $Typhoid = mysqli_real_escape_string($dbc, trim($_POST['Typhoid']));
    }
    // Check for a Vaccination:
    if (empty($_POST['Vaccination'])) {
        $errors[] = '<b style="color:black;">You forgot to enter Employee Vaccination.</b>';
    } else {
        $Vaccination = mysqli_real_escape_string($dbc, trim($_POST['Vaccination']));
    }

    $name = $_FILES['file']['name'];
    $target_dir = "../Images/Employee_Image/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    if (empty($errors)) { // If everything's OK.

        // Check extension
        if (in_array($imageFileType, $extensions_arr)) {
            // Upload file
            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $name)) {

                // Insert record Profile

                 // Make the query
                $query = "INSERT INTO profile (Username, Image_Name, Phone, First_Name, Last_Name, Email,
                Password, Gender, Address, State, Postal_Code, City, Country,
                DOB, Nationality, Merital_Status, Identity_No, Vaccination, Typhoid, Bank_Name, Account_No)
                VALUES ('$Username','$name', '$Phone', '$First_Name', '$Last_Name', '$Email', '$Password', 
                '$Gender', '$Address', '$State', '$Postal_Code', '$City', '$Country', '$DOB', '$Nationality', 
                '$Merital_Status', '$Identity_No', '$Vaccination', '$Typhoid', '$Bank_Name', '$Account_No')";
                $result = mysqli_query($dbc, $query); // Run the query.
            }
        }

        if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

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
                                <p class="mb-0">You are now add a new uppdate Employee Profile</p>
                            </div>
                            <a class="btn btn-light" href="Employees_Profile.php"><i class="ti-home mr-2"></i>Back to Employee Profile</a>
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
                            <a class="btn btn-light" href="Employees_Profile.php"><i class="ti-home mr-2"></i>Back to Employee Profile</a>                        
                        </div>
                    </div>
                </div>';
        } // End of if ($r) IF.

        mysqli_close($dbc); // Close the database connection.
        // Include the footer and quit the script:
        include '../partials/Footer.html';
        exit();
    } else { // Report the errors.

        echo '
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card-body">
                            <div class="alert alert-warning alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <h1><strong>Error!</strong> </h1>
                                <p class="mb-0">The following error(s) occurred:</p><br/>';
                                foreach ($errors as $msg) { // Print each error.
                                    echo " - $msg<br />\n";
                                }
                                echo '
                                </p><p class="mb-0">Please try again.</p><p><br /></p>
                            </div>
                            <a class="btn btn-light" href="Employees_Profile.php"><i class="ti-home mr-2"></i>Back to Employee Profile</a> 
                        </div>
                    </div>
                </div>';
    } // End of if (empty($errors)) IF.
    mysqli_close($dbc); // Close the database connection.
    include '../partials/Footer.html';
    exit();

} // End of the main Submit conditional.
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Employee Profile</h4>
                        <form class="forms-sample" action="Employees_Profile.php" method="post"
                            enctype="multipart/form-data">
                            <p class="card-description">
                                Create New Employee Personal Information
                            </p>

                            <div class="row">
                                <!--========== Input Employee Username ==========-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Username</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">@</span>
                                                </div>
                                                <input type="text" class="form-control" name="Username"
                                                    placeholder="Enter Employee Username Eg:-Azman98" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--========== Input Employee Image ==========-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Employee Image</label>

                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="file">
                                                <label class="custom-file-label" for="validatedCustomFile">Choose
                                                    Employee file...</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <!--========== Input Employee First Name ==========-->
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">First
                                            Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"
                                                placeholder="Enter Employee First Name Eg:-Muhammad" name="First_Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--========== Input Employee Last Name ==========-->
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Last
                                            Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"
                                                placeholder="Enter Employee Last Name Eg:-Azman" name="Last_Name">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <!--========== Input Employee Email ==========-->
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"
                                                placeholder="Enter Employee Email Eg:-Azman@BurgerByte" name="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--========== Input Employee Password ==========-->
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control"
                                                placeholder="Enter Employee Password Eg:-251251" name="Password">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!--========== Input Employee Phone ==========-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Number
                                            Phone</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"
                                                placeholder="Enter Employee Number Phone Eg:-019-5139569" name="Phone">
                                        </div>
                                    </div>
                                </div>
                                <!--========== Input Employee Gender ==========-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Gender</label>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="Gender"
                                                        value="Male">
                                                    Male
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="Gender"
                                                        value="Female">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--========== Employee Address ==========-->
                            <p class="card-description">
                                Address
                            </p>
                            <div class="row">
                                <!--========== Employee Street Address ==========-->
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Address 1</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="Address"
                                                placeholder="Enter Employee Street Address Eg:-Persiaran Kusmawangi, Taman Wangi Selalu" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!--========== Employee State ==========-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">State</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="State">
                                                <option value="">---- Please Select Employee State ----</option>
                                                <option value="Perlis">Perlis</option>
                                                <option value="Selangor">Selangor</option>
                                                <option value="Perak">Perak</option>
                                                <option value="Pulau Pinang">Pulau Pinang</option>
                                                <option value="Melaka">Melaka</option>
                                                <option value="Johor">Johor</option>
                                                <option value="Kedah">Kedah</option>
                                                <option value="Sabah">Sabah</option>
                                                <option value="Sarawak">Sarawak</option>
                                                <option value="Kelantan">Kelantan</option>
                                                <option value="Terengganu">Terengganu</option>
                                                <option value="N.Sembilan">N.Sembilan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--========== Employee  Postal Code ==========-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Postcode</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="Postal_Code"
                                                placeholder="Enter Employee Postal Code Eg:-32400" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!--========== Employee City ==========-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">City</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="City"
                                                placeholder="Enter Employee City Eg:-Perak" />
                                        </div>
                                    </div>
                                </div>
                                <!--========== Employee  Country ==========-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Country</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="Country"
                                                placeholder="Enter Employee CountryEg:-Malaysia" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!--========== Employee Account No ==========-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Account No</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="AccountNoField"
                                                name="Account_No" placeholder="0000-0000-0000-0000">
                                        </div>
                                    </div>
                                </div>
                                <!--========== Employee  Bank Name ==========-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Bank Name</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="Bank_Name" id="BankNameField">
                                                <option value="">---- Please Select Bank Name ----</option>
                                                <option value="Bank Islam">Bank Islam</option>
                                                <option value="RHB Bank Berhad">RHB Bank Berhad</option>
                                                <option value="Public Bank Berhad">Public Bank Berhad</option>
                                                <option value="Maybank">Maybank</option>
                                                <option value="CIMB Bank Berhad">CIMB Bank Berhad</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!--========== Employee DOB ==========-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Date of Birth</label>
                                        <div class="col-sm-9" class="form-control">
                                            <input type="date" name="DOB" id="DOB" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <!--========== Employee  Nationality  ==========-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nationaility</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="Nationality">
                                                <option value="">---- Please Select Employee Nationaility ----</option>
                                                <option value="Nationality">Nationality</option>
                                                <option value="Non - Nationality">Non - Nationality</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <!--========== Employee Merital Status ==========-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Merital Status</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="Merital_Status">
                                                <option value="">---- Please Select Employee Merital Status ----</option>
                                                <option value="Married">Married</option>
                                                <option value="Single">Single</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Dicvorced">Dicvorced</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--========== Employee  Identity_No  ==========-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Identity No</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="Identity_No"
                                                placeholder=" Enter Employee Identity Number" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!--========== Employee Vaccination ==========-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Vaccination</label>
                                        <div class="col-sm-3">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="Vaccination"
                                                        value="None">
                                                    None
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="Vaccination"
                                                        value="Partial Vaccination">
                                                    Partial Vaccination
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="Vaccination"
                                                        value="Fully Vaccination">
                                                    Fully Vaccination
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--========== Employee Typhoid ==========-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Typhoid</label>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="Typhoid"
                                                        value="Yes">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="Typhoid"
                                                        value="No">
                                                    Nope
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12" align="right">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="reset" class="btn btn-light" name="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--========== INCLUDE FOOTER ==========-->
        <?php include '../partials/Footer.html';?>
        <!-- Plugin js for this page -->