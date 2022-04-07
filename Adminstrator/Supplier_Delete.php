<!--========== HOMEBOARD BOOKING DELETE - ADMINSTRATOR LOGIN ==========-->
<?php 

$page_title = 'Supplier';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';

// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                        <p class="alert-heading"><h1>Error</h1></p>
                        <hr>
                        <p class="mb-0">This page has been accessed in error <br />
                    </div>
                </div>
            </div>';
    include '../partials/Footer.html';
	exit();
}

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['sure'] == 'Yes') { // Delete the record.

		// Make the query:
		$query = "DELETE FROM supplier WHERE Supplier_Id=$id LIMIT 1";		
		$result = @mysqli_query ($dbc, $query);
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
                                <p class="alert-heading"><h2><b>Delete Successfully</b></h2></p>
                                <p><b>Thank You</b> </p>
                                <hr>
                                <p class="mb-0">You are now delete an information of email list.</p>
                            </div>
                            <a class="btn btn-light" href="Supplier.php?id=1"><i class="ti-home mr-2"></i>Back to Reporting Page</a>
                        </div>
                    </div>
                </div>';	

		} else { // If the query did not run OK.
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
                            <a class="btn btn-light" href="Supplier.php?id=1"><i class="ti-home mr-2"></i>Back to Reporting Page</a>                        
                        </div>
                    </div>
                </div>';
		}
	
	} else { // No confirmation of deletion.
		echo '
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                            <p class="alert-heading"><h2><b>Error!</b></h2></p>
                            <hr>
                            <p class="mb-0">The email list information has <b>NOT</b> been deleted.</p><br/>
                        </div>
                        <a class="btn btn-light" href="Supplier.php?id=1"><i class="ti-home mr-2"></i>Back to Reporting Page</a>                        
                    </div>
                </div>
            </div>';	
	}

} else { // Show the form.

	// Retrieve the user's information:
	$query = "SELECT *
              FROM supplier 
              WHERE Supplier_Id=$id";
	$supplier = @mysqli_query ($dbc, $query);

    // Count the number of returned rows:
    $supplier_num = mysqli_num_rows($supplier);

	if (mysqli_num_rows($supplier) == 1) { // Valid user ID, show the form.

		// Get the user's information:
		$row = mysqli_fetch_array ($supplier, MYSQLI_NUM);
		
		// Display the record being deleted:
		echo ""?>
<div class='main-panel'>
    <div class='content-wrapper'>
        <div class='row'>
            <div class='col-md-12 grid-margin stretch-card'>
                <div class='card'>
                    <div class='card-body'>
                        <p class='card-title'>Delete Supplier Email</p>
                        <h4>There are currently <b><?php echo "$supplier_num" ?> Supplier </b>
                            Registration for</h4>
                        <p class='card-description'>
                            Supplier Information <code>Delete</code>

                        <div class="row">
                            <!--========== Email ==========-->
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="Email"
                                            placeholder="Email Eg:-Azman@BurgerByte" value="<?php echo $row[2]; ?> " />
                                    </div>
                                </div>
                            </div>
                            <!--========== Email Subject ==========-->
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Subject</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="Subject">
                                            <option value="">---- Please Select Subject ----
                                            </option>
                                            <?php
                                                $Subject = array('Raw Material Ordering', 'Dry Material Ordering', 'Purchase Stock', 'Purchase Cooking Utensils');
                                                foreach ($Subject as $value) {
                                                if ($row[3] == $value) { // creating sticky
                                                    echo "<option value='" . $row[3] . "' selected>" . $row[3] . "</option>";
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

                        <form action="Supplier_Delete.php" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Are you sure you want to delete email
                                            information?</label>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="sure" value="Yes"
                                                        id="Yes" />
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="sure" value="No"
                                                        checked="checked" id="No">
                                                    Nope
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12" align="right">
                                <input class="btn btn-outline-danger mr-2" type="submit" name="submit" value="Submit" />
                                <input type="hidden" name="id" value=<?php echo" $id "?> />
                            </div>
                        </form>
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
                            <p class="alert-heading"><h1>Reporting</h1></p>
                            <p><b>Error</b></p>
                            <hr>
                            <p class="mb-0">This page has been accessed in error <br />
                            <b>Email</b> of supplier are currently <b>NOT</b> registered.</p>
                        </div>
                    <a class="btn btn-light" href="Supplier.php?id=1"><i class="ti-home mr-2"></i>Back to Reporting</a>                        
                </div>
            </div>';
        }

        } // End of the main submission conditional.

        mysqli_close($dbc);

        include '../partials/Footer.html';
        ?>