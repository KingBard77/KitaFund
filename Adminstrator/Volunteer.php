<!--========== VOLUNTEER ==========-->
<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
// Set the page title and include the HTML header:
$page_title = 'Volunteers';
include '../partials/Navbar - Adminstrator.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Adminstrator.php';
?>

<?php
// Define the query:
$query = "SELECT volunteer_name, volunteer_email, volunteer_description, volunteer_remark, volunteer_date
FROM volunteer
WHERE volunteer_id
ORDER BY volunteer_id ASC";
$volunteer = @mysqli_query($dbc, $query);

// Count the number of returned rows:
$volunteer_num = mysqli_num_rows($volunteer);

// Set the Volunteer method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.

    if (empty($_POST['volunteer_name'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Volunteer Name.</b>';
    } else {
        $volunteer_name = trim($_POST['volunteer_name']);
    }

    if (empty($_POST['volunteer_email'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Volunteer Email.</b>';
    } else {
        $volunteer_email = trim($_POST['volunteer_email']);
    }

    if (empty($_POST['volunteer_description'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Volunteer Description.</b>';
    } else {
        $volunteer_description = trim($_POST['volunteer_description']);
    }

    if (empty($_POST['volunteer_remark'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Volunteer Remark.</b>';
    } else {
        $volunteer_remark = trim($_POST['volunteer_remark']);
    }



    if (empty($errors)) { // If everything's OK.

        // Make the query
        $query = "INSERT INTO volunteer (volunteer_name, volunteer_email, volunteer_description, volunteer_remark)
        VALUES ('$volunteer_name', '$volunteer_email', '$volunteer_description', '$volunteer_remark')";
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
                                <p class="mb-0">You are now add a new volunteer</p>
                            </div>
                            <a class="btn btn-light" href="Volunteer.php"><i class="ti-home mr-2"></i>Back to Volunteer Page</a>
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
                            <a class="btn btn-light" href="Volunteer.php"><i class="ti-home mr-2"></i>Back to Volunteer Page</a>                        
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
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <h1><strong>Error!</strong> </h1>
                                <p class="mb-0">The following error(s) occurred:</p><br/>';
                                foreach ($errors as $msg) { // Print each error.
                                    echo " - $msg<br />\n";
                                }
                                echo '
                                </p><p class="mb-0">Please try again.</p><p><br /></p>
                            </div>
                            <a class="btn btn-light" href="Volunteer.php"><i class="ti-home mr-2"></i>Back to Volunteer Page</a> 
                        </div>
                    </div>
                </div>';
    } // End of if (empty($errors)) IF.
    mysqli_close($dbc); // Close the database connection.
    include '../partials/Footer.html';
    exit();

} // End of the main Submit conditional.

?>
<div class='main-panel'>
    <div class='content-wrapper'>
        <div class='row'>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Volunteer Account</h4>
                        <p class="card-description">
                            Create Volunteer Account
                        </p>
                        <button href="#Bar" class="btn btn-primary mr-2" style="float: right;"
                            data-toggle="collapse">Insert New Volunteer</button><br /><br /><br />
                        <div id="Bar" class="collapse in">
                            <form class="forms-sample" action="Volunteer.php" method="post"
                                enctype="multipart/form-data">
                                <!--========== Input Volunteer Name ==========-->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Volunteer Name</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="volunteer_name"
                                            placeholder="Enter Volunteer Name Eg:- Teh Khadijah" />
                                    </div>

                                    <!--========== Input Volunteer Email ==========-->
                                    <label class="col-sm-3 col-form-label" align="right">Volunteer Email</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="volunteer_email"
                                            placeholder="Enter Volunteer Email Eg:- Teh Khadijah@kitafund.com" />
                                    </div>
                                </div>

                                <!--========== Input Volunteer Description ==========-->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Volunteer Description</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="volunteer_description"
                                            placeholder="Why you want to become a volunteer?" />
                                    </div>
                                </div>

                                <!--========== Input Volunteer Remark ==========-->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Volunteer Remark</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="volunteer_remark"
                                            style="height: 40px;">
                                            <option value="">- Please Select Volunteer Remark -</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Unapproved">Unapproved</option>
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
                        <p class='card-title'>Manage Volunteers Account</p>
                        <h4>There are currently <b><?php echo "$volunteer_num" ?> Volunteers </b>
                            Registration for</h4>
                        <p class='card-description'>
                            Volunteers List <code>Manage</code>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="volunteer_remark" id="volunteer_remark"
                                                style="height: 40px;">
                                                <option value="">- Please Select Volunteer Remark -</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Unapproved">Unapproved</option>
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
                                                            <th>Volunteer Name</th>
                                                            <th>Volunteer Email</th>
                                                            <th>Volunteer Description</th>
                                                            <th class="text-center">Volunteer Remark</th>
                                                            <th class="text-center">Volunteer Date</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
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

        <!-- SCRIPT FOR FETCH RECORD VOLUNTEERS -->
        <script type="text/javascript">
        load_data(); // first load
        function load_data(initial_date, final_date, volunteer_remark) {
            var ajax_url = "../Database/volunteer/fetch_volunteer.php";

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
                        "action": "fetch_volunteer",
                        "initial_date": initial_date,
                        "final_date": final_date,
                        "volunteer_remark": volunteer_remark
                    },
                    "dataSrc": "records"
                },
                "columns": [{
                        "data": "volunteer_id"
                    },
                    {
                        "data": "volunteer_name"
                    },
                    {
                        "data": "volunteer_email"
                    },
                    {
                        "data": "volunteer_description"
                    },
                    {
                        "data": "volunteer_remark"
                    },
                    {
                        "data": "volunteer_date"
                    },
                    {
                        "data": "counter"
                    }
                ],
            });
        }

        // SCRIPT FOR FETCH SUBMIT DATA
        $(document).on('submit', '#updateUser', function(e) {
            e.preventDefault();
            //var tr = $(this).closest('tr');
            var volunteer_date = $('#volunteerDateField').val();
            var volunteer_remark = $('#volunteerRemarkField').val();
            var volunteer_description = $('#volunteerDescriptionField').val();
            var volunteer_email = $('#volunteerEmailField').val();
            var volunteer_name = $('#volunteerNameField').val();
            var trid = $('#trid').val();
            var id = $('#id').val();
            if (volunteer_name != '' && volunteer_email != '' && volunteer_description != '' 
                && volunteer_remark != '' && volunteer_date != '') {
                $.ajax({
                    url: "../Database/volunteer/update_volunteer.php",
                    type: "post",
                    data: {
                        volunteer_date: volunteer_date,
                        volunteer_remark: volunteer_remark,
                        volunteer_description: volunteer_description,
                        volunteer_name: volunteer_name,
                        volunteer_email: volunteer_email,
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
                                volunteer_email, volunteer_name,
                                volunteer_description, volunteer_remark, volunteer_date,
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
                url: "../Database/volunteer/single_data_Volunteer.php",
                data: {
                    id: id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#volunteerDateField').val(json.volunteer_date);
                    $('#volunteerRemarkField').val(json.volunteer_remark);
                    $('#volunteerDescriptionField').val(json.volunteer_description);
                    $('#volunteerEmailField').val(json.volunteer_email);
                    $('#volunteerNameField').val(json.volunteer_name);
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
                    url: "../Database/volunteer/delete_volunteer.php",
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
            var volunteer_remark = $("#volunteer_remark").val();

            if (initial_date == '' && final_date == '') {
                $('#records').DataTable().destroy();
                load_data("", "", volunteer_remark); // filter immortalize only
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
                        load_data(initial_date, final_date, volunteer_name);
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
                        <h5 class="modal-title" id="exampleModalLabel">Update Volunteer Account</h5>
                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon"
                            data-bs-dismiss="modal" aria-label="Close"><i class="ti-home"></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateUser" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="trid" id="trid" value="">
                            <div class="mb-3 row">
                            <label for="nameField" class="col-md-3 form-label">Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="volunteerNameField" name="volunteer_name"
                                    placeholder="volunteer Name Eg:-Teh Khadijah" disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="mobileField" class="col-md-3 form-label">Email</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="volunteerEmailField"
                                        placeholder="volunteer Email Eg:-TehKhadijah@KitaFund" name="volunteer_email">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="cityField" class="col-md-3 form-label">Description</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="volunteerDescriptionField"
                                        placeholder="Why you want to become a volunteer?" name="volunteer_description">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nameField" class="col-md-3 form-label">Remark</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="volunteer_remark" id="volunteerRemarkField"
                                        style="height: 40px;">
                                        <option value="">- Please Select Volunteer Remark -</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Unapproved">Unapproved</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nameField" class="col-md-3 form-label">Date</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="volunteerDateField"
                                        name="volunteer_date" disabled>
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