<!--========== ADMINSTRATOR PROFILE ==========-->
<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
// Set the page title and include the HTML header:
$page_title = 'My Profile';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.
    
    if (empty($_POST['First_Name'])) {
        $errors[] = 'You forgot to enter your First Name.';
    } else {
        $First_Name = trim($_POST['First_Name']);
    }

    if (empty($_POST['Last_Name'])) {
        $errors[] = 'You forgot to enter your Last Name.';
    } else {
        $Last_Name = trim($_POST['Last_Name']);
    }

    if (empty($_POST['Email'])) {
        $errors[] = 'You forgot to enter your Email.';
    } else {
        $Email = trim($_POST['Email']);
    }

    if (empty($_POST['Password'])) {
        $errors[] = 'You forgot to enter your Password';
    } else {
        $Password = trim($_POST['Password']);
    }

    if (empty($_POST['Phone'])) {
        $errors[] = 'You forgot to enter your Phone Number';
    } else {
        $Phone = trim($_POST['Phone']);
    }
    if (empty($_POST['Username'])) {
        $errors[] = 'You forgot to enter your Username.';
    } else {
        $Username = mysqli_real_escape_string($dbc, trim($_POST['Username']));
    }
    // Check for a Gender:
    if (empty($_POST['Gender'])) {
        $errors[] = 'You forgot to enter your Gender.';
    } else {
        $Gender = mysqli_real_escape_string($dbc, trim($_POST['Gender']));
    }
    // Check for a DOB:
    if (empty($_POST['DOB'])) {
        $errors[] = 'You forgot to enter your Date of Birth.';
    } else {
        $DOB = mysqli_real_escape_string($dbc, trim($_POST['DOB']));
    }
    // Check for a Address:
    if (empty($_POST['Address'])) {
        $errors[] = 'You forgot to enter your Address.';
    } else {
        $Address = mysqli_real_escape_string($dbc, trim($_POST['Address']));
    }
    // Check for a City:
    if (empty($_POST['City'])) {
        $errors[] = 'You forgot to enter your City.';
    } else {
        $City = mysqli_real_escape_string($dbc, trim($_POST['City']));
    }
    // Check for a State:
    if (empty($_POST['State'])) {
        $errors[] = 'You forgot to enter your State.';
    } else {
        $State = mysqli_real_escape_string($dbc, trim($_POST['State']));
    }
    // Check for a Postal Code:
    if (empty($_POST['Postal_Code'])) {
        $errors[] = 'You forgot to enter your Postal Code.';
    } else {
        $Postal_Code = mysqli_real_escape_string($dbc, trim($_POST['Postal_Code']));
    }
    // Check for a Country:
    if (empty($_POST['Country'])) {
        $errors[] = 'You forgot to enter your Country.';
    } else {
        $Country = mysqli_real_escape_string($dbc, trim($_POST['Country']));
    }
    // Check for a Merital Status:
    if (empty($_POST['Merital_Status'])) {
        $errors[] = 'You forgot to enter your Merital Status.';
    } else {
        $Merital_Status = mysqli_real_escape_string($dbc, trim($_POST['Merital_Status']));
    }
    // Check for a Nationality:
    if (empty($_POST['Nationality'])) {
        $errors[] = 'You forgot to enter your Nationality.';
    } else {
        $Nationality = mysqli_real_escape_string($dbc, trim($_POST['Nationality']));
    }
    // Check for a Identity No:
    if (empty($_POST['Identity_No'])) {
        $errors[] = 'You forgot to enter your Identity Number.';
    } else {
        $Identity_No = mysqli_real_escape_string($dbc, trim($_POST['Identity_No']));
    }
    // Check for a Typhoid:
    if (empty($_POST['Typhoid'])) {
        $errors[] = 'You forgot to enter your Typhoid.';
    } else {
        $Typhoid = mysqli_real_escape_string($dbc, trim($_POST['Typhoid']));
    }
    // Check for a Vaccination:
    if (empty($_POST['Vaccination'])) {
        $errors[] = 'You forgot to enter your Vaccination.';
    } else {
        $Vaccination = mysqli_real_escape_string($dbc, trim($_POST['Vaccination']));
    }

    $name = $_FILES['file']['name'];
    $target_dir = "../Images/Profile_Image/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png", "gif");
    
    // Check extension
    if (in_array($imageFileType, $extensions_arr)) {
        // Upload file
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $name)) {
        }
    }

            if (empty($errors)) { // If everything's OK.
                $query = "UPDATE profile SET
                Image_Name='$name', Username='$Username', First_Name='$First_Name', Last_Name='$Last_Name', 
                Email='$Email', Password='$Password', Phone='$Phone', Gender='$Gender', DOB='$DOB', Address='$Address',
                City='$City', State='$State', Postal_Code='$Postal_Code', Country='$Country', Merital_Status='$Merital_Status',
                Nationality='$Nationality', Identity_No='$Identity_No', Typhoid='$Typhoid', Vaccination='$Vaccination'
                WHERE Profile_Id=$id LIMIT 1";
                $result = mysqli_query($dbc, $query);


        if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
            // Print a message:
            echo '
            <!-- SUCCESSFULLY MESSAGE -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                <p class="alert-heading"><h2>Update Successfully</h2></p>
                                <p><b>Thank You</b> </p>
                                <hr>
                                <p class="mb-0">You are now update a new  information in your profile</p>
                            </div>
                            <a class="btn btn-light" href="My_Profile.php"><i class="ti-home mr-2"></i>Back to Profile Page</a>
                        </div>
                    </div>
                </div>';
        } else { // If it did not run OK.
            // Public message:
            echo '
            <!-- ERROR MESSAGE -->
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
                            <a class="btn btn-light" href="My_Profile.php"><i class="ti-home mr-2"></i>Back to Profile Page</a>                        
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
                            <a class="btn btn-light" href="My_Profile.php"><i class="ti-home mr-2"></i>Back to Profile</a> 
                        </div>
                    </div>
                </div>';
    } // End of if (empty($errors)) IF.
    mysqli_close($dbc); // Close the database connection.
    include '../partials/Footer.html';
    exit();
} // End of the main Submit conditional.

// Always show the form...

// Retrieve the user's information:
$query = "SELECT p.Profile_Id, p.Image_Name, o.Owner_Code, p.Username, p.First_Name, p.Last_Name, p.Email,
p.Password, p.Phone, p.Gender, p.Address, p.City, p.State, p.Postal_Code, p.Country, p.DOB, p.Merital_Status,
p.Nationality, p.Identity_No, p.Typhoid, p.Vaccination, p.Joining_Date
FROM owner o, profile p
WHERE p.Profile_Id = $id
AND o.Profile_Id = p.Profile_Id";
$owner = mysqli_query($dbc, $query);

if (mysqli_num_rows($owner) == 1) { // Valid user ID, show the form.

    // Get the user's information:
    $row = mysqli_fetch_array($owner, MYSQLI_NUM); //MYSQLI_ASSOC
    // Count the number of returned rows:
    $owner_num = mysqli_num_rows($owner);


// Create the form:
echo '';?>
<div class="main-panel">
    <div class="content-wrapper">
        <form class="forms-sample" action="My_Profile.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">My Profile</h4>
                            <p class='card-description'>
                            <p>There are currently <?php echo" <b> $owner_num </b>";?>Total Owner</p>
                            </p>
                            <div class="row">
                                <div class="col-md-4 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-description">
                                                Profile Picture
                                            </p>

                                            <div class="row">
                                                <!--========== My Profile Picture ==========-->
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <?php
                                                                $image = $row[1];
                                                                $image_src = "../Images/Profile_Image/" . $image;
                                                            ?>
                                                            <img src="<?php echo $image_src; ?>" alt="Profile Image"
                                                                class="rounded-circle img-fluid mx-auto d-block"
                                                                width="350px" height="250px">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!--========== Input Profile Image ==========-->
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Profile Image</label>
                                                        <div class="col-sm-9">
                                                            <input type="file" name="file" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <!--========== Input Joining Date ==========-->
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Joining Date</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="Joining_Date"
                                                                value="<?php echo $row[21]; ?> " disabled />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-description">
                                                Profile Information
                                            </p>

                                            <div class="row">
                                                <!--========== Input Owner Code ==========-->
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Owner Code</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="Owner_Code"
                                                                value="<?php echo $row[2]; ?> " disabled />
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--========== Input Owner Username ==========-->
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Username</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">@</span>
                                                                </div>
                                                                <input type="text" class="form-control" name="Username"
                                                                placeholder="Username Eg:-Azman" value="<?php echo $row[3]; ?> " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <!--========== Input Owner First Name ==========-->
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">First Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="First_Name"
                                                            placeholder="First Name Eg:-Muhammad" value="<?php echo $row[4]; ?> " />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--========== Input Owner Last Name ==========-->
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Last Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="Last_Name"
                                                            placeholder="Last Name Eg:-Azman" value="<?php echo $row[5]; ?> " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!--========== Input Owner Email ==========-->
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Email</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="Email"
                                                            placeholder="Email Eg:-Azman@BurgerByte" value="<?php echo $row[6]; ?> " />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--========== Input Owner Password ==========-->
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Password</label>
                                                        <div class="col-sm-9">
                                                            <input type="password" class="form-control" name="Password"
                                                            placeholder="Password Eg:-251251" value="<?php echo $row[7]; ?> " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!--========== Input Owner Phone ==========-->
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Phone Number</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="Phone"
                                                            placeholder="Number Phone Eg:-019-5139569" value="<?php echo $row[8]; ?> " />
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--========== Input Owner Gender ==========-->
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Gender</label>
                                                        <div class="col-sm-4">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input"
                                                                        name="Gender" id="Male" value="male"
                                                                        <?php if($row[9]=="male"){ echo "checked";}?> />
                                                                    Male
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
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

                                            <!--========== Owner Address ==========-->
                                            <p class="card-description">
                                                Address
                                            </p>
                                            <div class="row">
                                                <!--========== Owner Street Address ==========-->
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Street Address </label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" name="Address"
                                                            placeholder="Street Address Eg:-Persiaran Kusmawangi, Taman Wangi Selalu"
                                                            value="<?php echo $row[10]; ?> " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!--========== Owner State ==========-->
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
                                                <!--========== Owner  Postal Code ==========-->
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Postcode</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="Postal_Code"
                                                            placeholder="Postal Code Eg:-32400" value="<?php echo $row[13]; ?> " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!--========== Owner City ==========-->
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">City</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="City"
                                                            placeholder="City Eg:-Perak" value="<?php echo $row[11]; ?> " />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--========== Owner  Country ==========-->
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Country</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="Country"
                                                            placeholder="Country Eg:-Malaysia" value="<?php echo $row[14]; ?> " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!--========== Owner DOB ==========-->
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Date of Birth</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="DOB"
                                                                id="from-datepicker" value="<?php echo $row[15]; ?> " />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--========== Owner  Nationality  ==========-->
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
                                                <!--========== Owner Merital Status ==========-->
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
                                                <!--========== Owner  Identity_No  ==========-->
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Identity No</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="Identity_No"
                                                            placeholder="Employee Identity Number Eg:-987501015522" value="<?php echo $row[18]; ?> " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!--========== Owner Vaccination ==========-->
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

                                                <!--========== Owner Typhoid ==========-->
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
                                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                            <button class="btn btn-light">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>



        <?php
} else { // Not a valid user ID.
    echo'
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                        <p class="alert-heading"><h1>My Profile</h1></p>
                        <p><b>Error</b></p>
                        <hr>
                        <p class="mb-0">This page has been accessed in error <br />
                        <b>Owner Profolio</b> are currently <b>NOT</b> registered.</p>
                    </div>
                <a class="btn btn-light" href="Dashboard.php"><i class="ti-home mr-2"></i>Back to Dashboard</a>                        
            </div>
        </div>';
}

mysqli_close($dbc);
?>

        <!--========== INCLUDE FOOTER ==========-->
        <?php include '../partials/Footer.html';?>
        <!-- Plugin js for this page -->