<!--========== EMPLOYEES ==========-->
<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
// Set the page title and include the HTML header:
$page_title = 'Employees';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';
?>

<?php
// Define the query:
$query = "SELECT p.Profile_Id, e.Employee_Code, p.Image_Name, p.First_Name, p.Last_Name, 
p.Email, p.Phone, p.Joining_Date
FROM employee e, profile p
WHERE e.Profile_Id = p.Profile_Id
ORDER BY p.Profile_Id ASC";
$employee = @mysqli_query($dbc, $query);

// Count the number of returned rows:
$employee_num = mysqli_num_rows($employee);

// Set the Stock Inventory method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.

    if (empty($_POST['Employee_Code'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Employee Code.</b>';
    } else {
        $Employee_Code = trim($_POST['Employee_Code']);
    }

    if (empty($_POST['Profile_Id'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Employee Code.</b>';
    } else {
        $Profile_Id = trim($_POST['Profile_Id']);
    }

    if (empty($errors)) { // If everything's OK.

        // Make the query
        $query = "INSERT INTO employee (Employee_Code, Profile_Id)
        VALUES ('$Employee_Code', '$Profile_Id')";
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
                                <p class="mb-0">You are now add a new Employee</p>
                            </div>
                            <a class="btn btn-light" href="Employees.php"><i class="ti-home mr-2"></i>Back to Employee Page</a>
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
                            <a class="btn btn-light" href="Employees.php"><i class="ti-home mr-2"></i>Back to Employee Page</a>                        
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
                            <a class="btn btn-light" href="Employees.php"><i class="ti-home mr-2"></i>Back to Employee Page</a> 
                        </div>
                    </div>
                </div>';
    } // End of if (empty($errors)) IF.
    mysqli_close($dbc); // Close the database connection.
    include 'partials/Footer.html';
    exit();

} // End of the main Submit conditional.

?>
<div class='main-panel'>
    <div class='content-wrapper'>
        <div class='row'>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Employee Account</h4>
                        <p class="card-description">
                            Create Employee Account
                        </p>
                        <button href="#Bar" class="btn btn-primary mr-2" style="float: right;"
                            data-toggle="collapse">Insert New Employee</button><br /><br /><br />
                        <div id="Bar" class="collapse in">
                            <form class="forms-sample" action="Employees.php" method="post"
                                enctype="multipart/form-data">
                                <!--========== Input Employee Code ==========-->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Employee Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="Employee_Code"
                                            placeholder="Enter Employee Code Eg:- EMP20**" />
                                    </div>
                                </div>
                                <!--========== Input Employee Username ==========-->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Employee Username</label>
                                    <div class="col-sm-9">
                                        <select name="Profile_Id" class="form-control">
                                            <option>---- Please Select Employee Username ----</option>
                                            <?php
                                                $sql = "SELECT p.Username, p.Profile_Id
                                                FROM profile p
                                                ORDER BY p.Profile_Id ASC";
                                                $all_profile = mysqli_query($dbc, $sql);
                                                
                                                while ($profile = mysqli_fetch_array(
                                                $all_profile, MYSQLI_ASSOC)): ;
                                            ?>
                                            <option value="<?php echo $profile["Profile_Id"];?>">
                                                <?php echo $profile["Username"];
                                                    ?>
                                            </option>
                                            <?php
                                                endwhile;
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12" align="right">
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-12 grid-margin stretch-card'>
                <div class='card'>
                    <div class='card-body'>
                        <p class='card-title'>Manage Employees Account</p>
                        <h4>There are currently <b><?php echo "$employee_num" ?> Employees </b>
                            Registration for</h4>
                        <p class='card-description'>
                            Employee List <code>Manage</code>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="Employee_Code" id="Employee_Code"
                                                style="height: 40px;">
                                                <option value="">---- Select Employee Code Filtering ----</option>
                                                <?php
                                                    $sql = "SELECT * FROM employee";
                                                    $all_employee = mysqli_query($dbc, $sql);

                                                    while ($employee = mysqli_fetch_array(
                                                    $all_employee,MYSQLI_ASSOC)):; 
                                                ?>
                                                <option value="<?php echo $employee["Employee_Code"];?>">
                                                    <?php echo $employee["Employee_Code"];?>
                                                </option>
                                                <?php 
                                                    endwhile; 
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <input class="form-control datepicker" type="date" name="initial_date"
                                                id="initial_date" placeholder="yyyy-mm-dd" style="height: 40px;" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <input class="form-control datepicker" type="date" name="final_date"
                                                id="final_date" placeholder="yyyy-mm-dd" style="height: 40px;" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button name="filter" id="filter"
                                        class="btn btn-outline-info btn-sm">Filter</button>
                                    <button id="reset-btn" onClick="refreshPage()"
                                        class="btn btn-outline-warning btn-sm">Reset</button>
                                </div>
                                <div class="col-sm-12 text-danger" id="error_log"></div>
                                <br />
                                <div class="row">
                                    <div class="col-12">
                                        <div style="width: 100%;">
                                            <!-- Table -->
                                            <div class="table-responsive">
                                                <table class="display expandable-table dt-responsive display nowrap"
                                                    style="width:100%" id="records">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th>Image</th>
                                                            <th>Employee Code</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Email</th>
                                                            <th class='text-center'>Phone</th>
                                                            <th class='text-center'>Joining Date</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>

        <!-- Datatables -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js">
        </script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js">
        </script>
        <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
        </script>

        <!-- SCRIPT FOR FETCH RECORD EMPLOYEE -->
        <script type="text/javascript">
        load_data(); // first load
        function load_data(initial_date, final_date, Employee_Code) {
            var ajax_url = "../Database/Employee/fetch_employee.php";

            $('#records').DataTable({
                "fnCreatedRow": function(nRow, aData, iDataIndex) {
                    $(nRow).attr('id', aData[0]);
                },
                'serverSide': 'true',
                'processing': 'true',
                'paging': 'true',
                'iDisplayLength': 10,
                "responsive": true,
                "order": [
                    [0, "desc"]
                ],
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                language: {
                    search: "_INPUT_", //To remove Search Label
                    searchPlaceholder: "Search Anyrhing"
                },
                "dom": "<'row'<'col-12 col-md-6'l><'col-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>" +
                    "<'row'<'col-12 col-md-6'B>>",
                buttons: {
                    "buttons": [{
                            extend: 'copy',
                            className: '',
                            text: '<i class="far fa-copy"></i> Copy',
                            title: $('h1').text(),
                            exportOptions: {
                                columns: ':not(.no-print)'
                            }
                        },
                        {
                            extend: 'excel',
                            text: '<i class="far fa-file-excel"></i> Excel',
                            title: $('h1').text(),
                            exportOptions: {
                                columns: ':not(.no-print)'
                            }
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="far fa-file-pdf"></i> Pdf',
                            title: $('h1').text(),
                            exportOptions: {
                                columns: ':not(.no-print)'
                            }
                        },
                        {
                            extend: 'csv',
                            text: '<i class="fas fa-file-csv"></i> CSV',
                            title: $('h1').text(),
                            exportOptions: {
                                columns: ':not(.no-print)'
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i> Print',
                            title: $('h1').text(),
                            exportOptions: {
                                columns: ':not(.no-print)'
                            },
                            footer: true,
                            autoPrint: false
                        }
                    ],
                    dom: {
                        container: {
                            className: 'dt-buttons'
                        },
                        button: {
                            className: 'btn btn-outline-secondary btn-sm'
                        }
                    }
                },
                "ajax": {
                    "url": ajax_url,
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        "action": "fetch_employee",
                        "initial_date": initial_date,
                        "final_date": final_date,
                        "Employee_Code": Employee_Code
                    },
                    "dataSrc": "records"
                },
                "columns": [{
                        "data": "Profile_Id"
                    },
                    {
                        "data": "Image_Name"
                    },
                    {
                        "data": "Employee_Code"
                    },
                    {
                        "data": "First_Name"
                    },
                    {
                        "data": "Last_Name"
                    },
                    {
                        "data": "Email"
                    },
                    {
                        "data": "Phone"
                    },
                    {
                        "data": "Joining_Date"
                    },
                    {
                        "data": "counter"
                    }
                ]
            });
        }

        // SCRIPT FOR FETCH SUBMIT DATA
        $(document).on('submit', '#updateUser', function(e) {
            e.preventDefault();
            //var tr = $(this).closest('tr');
            var Joining_Date = $('#JoiningDateField').val();
            var Phone = $('#PhoneField').val();
            var Email = $('#EmailField').val();
            var Last_Name = $('#LastNameField').val();
            var First_Name = $('#FirstNameField').val();
            var Employee_Code = $('#EmployeeCodeField').val();
            var Image_Name = $('#ImageNameField').val();
            var trid = $('#trid').val();
            var id = $('#id').val();
            if (Employee_Code != '' && Image_Name != '' && First_Name != '' &&
                Last_Name != '' && Email !=
                '' && Phone != '' && Joining_Date != '') {
                $.ajax({
                    url: "../Database/Employee/update_employee.php",
                    type: "post",
                    data: {
                        Joining_Date: Joining_Date,
                        Phone: Phone,
                        Email: Email,
                        Last_Name: Last_Name,
                        First_Name: First_Name,
                        Employee_Code: Employee_Code,
                        Image_Name: Image_Name,
                        id: id
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;
                        if (status == 'true') {
                            table = $('#records').DataTable();
                            var button = '<td><a href="javascript:void();" data-id="' + id +
                                '" class="btn btn-outline-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' +
                                id +
                                '" class="btn btn-outline-danger btn-sm deleteBtn">Delete</a></td>';
                            var row = table.row("[id='" + trid + "']");
                            row.row("[id='" + trid + "']").data([id,
                                Image_Name, Employee_Code, First_Name,
                                Last_Name, Email, Phone,
                                Joining_Date,
                                button
                            ]);
                            $('#exampleModal').modal('hide');
                        } else {
                            alert('failed');
                        }
                    }
                });
            } else {
                alert('Fill all the required fields');
            }
        });

        // SCRIPT FOR FETCH SINGLE DATA
        $('#records').on('click', '.editbtn ', function(event) {
            var table = $('#records').DataTable();
            var trid = $(this).closest('tr').attr('id');
            // console.log(selectedRow);
            var id = $(this).data('id');
            $('#exampleModal').modal('show');

            $.ajax({
                url: "../Database/Employee/single_data_employee.php",
                data: {
                    id: id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#JoiningDateField').val(json.Joining_Date);
                    $('#PhoneField').val(json.Phone);
                    $('#EmailField').val(json.Email);
                    $('#LastNameField').val(json.Last_Name);
                    $('#FirstNameField').val(json.First_Name);
                    $('#ImageNameField').val(json.Image_Name);
                    $('#EmployeeCodeField').val(json.Employee_Code);
                    $('#id').val(id);
                    $('#trid').val(trid);
                }
            })
        });

        // SCRIPT FOR DELETE SINGLE DATA
        $(document).on('click', '.deleteBtn', function(event) {
            var table = $('#records').DataTable();
            event.preventDefault();
            var id = $(this).data('id');
            if (confirm("Are you sure want to delete this User ? ")) {
                $.ajax({
                    url: "../Database/Employee/delete_employee.php",
                    data: {
                        id: id
                    },
                    type: "post",
                    success: function(data) {
                        var json = JSON.parse(data);
                        status = json.status;
                        if (status == 'success') {
                            $("#" + id).closest('tr').remove();
                        } else {
                            alert('Failed');
                            return;
                        }
                    }
                });
            } else {
                return null;
            }
        })

        // SCRIPT FOR FILTER BUTTON
        $("#filter").click(function() {
            var initial_date = $("#initial_date").val();
            var final_date = $("#final_date").val();
            var Employee_Code = $("#Employee_Code").val();

            if (initial_date == '' && final_date == '') {
                $('#records').DataTable().destroy();
                load_data("", "", Employee_Code); // filter immortalize only
            } else {
                var date1 = new Date(initial_date);
                var date2 = new Date(final_date);
                var diffTime = Math.abs(date2 - date1);
                var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (initial_date == '' || final_date == '') {
                    $("#error_log").html(
                        "Warning: You must select both (start and end) date.</span>");
                } else {
                    if (date1 > date2) {
                        $("#error_log").html(
                            "Warning: End date should be greater then start date.");
                    } else {
                        $("#error_log").html("");
                        $('#records').DataTable().destroy();
                        load_data(initial_date, final_date, Employee_Code);
                    }
                }
            }
        });

        // SCRIPT FOR REFRESH BUTTON
        function refreshPage() {
            window.location.reload();
        }
        </script>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Employee Profile</h5>
                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon"
                            data-bs-dismiss="modal" aria-label="Close"><i class="ti-home"></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateUser" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="trid" id="trid" value="">
                            <div class="mb-3 row">
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="ImageNameField" name="Image_Name"
                                        hidden>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nameField" class="col-md-3 form-label">Employee Code</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="EmployeeCodeField" name="Employee_Code"
                                        disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nameField" class="col-md-3 form-label">First Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="FirstNameField"
                                        placeholder="First Name Eg:-Muhammad" name="First_Name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="emailField" class="col-md-3 form-label">Last Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="LastNameField"
                                        placeholder="Last Name Eg:-Azman" name="Last_Name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="mobileField" class="col-md-3 form-label">Email</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="EmailField"
                                        placeholder="Email Eg:-Azman@BurgerByte" name="Email">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="cityField" class="col-md-3 form-label">Phone</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="PhoneField"
                                        placeholder="Number Phone Eg:-019-5139569" name="Phone">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="cityField" class="col-md-3 form-label">Joining Date</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="JoiningDateField" name="Joining_Date"
                                        disabled>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-icon-text" onClick="refreshPage()"><i
                                        class="ti-file btn-icon-prepend"></i>Submit</button>
                                <button type="button" class="btn btn-inverse-secondary btn-fw"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include '../partials/Footer.html';?>