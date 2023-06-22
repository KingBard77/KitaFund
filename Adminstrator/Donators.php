<!--========== DONATORS ==========-->
<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
// Set the page title and include the HTML header:
$page_title = 'Donators';
include '../partials/Navbar - Adminstrator.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Adminstrator.php';
?>

<?php
// Define the query:
$query = "SELECT donator_id, donator_name, donator_email, donator_ic, donator_phone, 
donator_card_number, donator_name_holder, ccv, expired_date, amount, donator_date
FROM donator
WHERE donator_id
ORDER BY donator_id ASC";
$donator = @mysqli_query($dbc, $query);

// Count the number of returned rows:
$donator_num = mysqli_num_rows($donator);

// Set the Donators method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.

    if (empty($_POST['donator_name'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Donator Name.</b>';
    } else {
        $donator_name = trim($_POST['donator_name']);
    }

    if (empty($_POST['donator_email'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Donator Email.</b>';
    } else {
        $donator_email = trim($_POST['donator_email']);
    }

    if (empty($_POST['donator_ic'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Donator Identity Card Number.</b>';
    } else {
        $donator_ic = trim($_POST['donator_ic']);
    }

    if (empty($_POST['donator_phone'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Donator Phone Number.</b>';
    } else {
        $donator_phone = trim($_POST['donator_phone']);
    }

    if (empty($_POST['donator_name_holder'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Donator Name Holder.</b>';
    } else {
        $donator_name_holder = trim($_POST['donator_name_holder']);
    }

    if (empty($_POST['donator_card_number'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Donator Card Number.</b>';
    } else {
        $donator_card_number = trim($_POST['donator_card_number']);
    }

    if (empty($_POST['ccv'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Donator CCV Number.</b>';
    } else {
        $ccv = trim($_POST['ccv']);
    }

    if (empty($_POST['expired_date'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Donator Expired Month.</b>';
    } else {
        $expired_date = trim($_POST['expired_date']);
    }

    if (empty($_POST['amount'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Donation Amount.</b>';
    } else {
        $amount = trim($_POST['amount']);
    }


    if (empty($errors)) { // If everything's OK.

        // Make the query
        $query = "INSERT INTO donator (donator_name, donator_email, donator_ic, donator_phone, 
        donator_card_number, donator_name_holder, ccv, expired_date, amount)
        VALUES ('$donator_name', '$donator_email', '$donator_ic', '$donator_phone', '$donator_card_number', 
        '$donator_name_holder', '$ccv', '$expired_date', '$amount')";
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
                                <p class="mb-0">You are now add a new Donators</p>
                            </div>
                            <a class="btn btn-light" href="Donators.php"><i class="ti-home mr-2"></i>Back to Donators Page</a>
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
                            <a class="btn btn-light" href="Donators.php"><i class="ti-home mr-2"></i>Back to Donators Page</a>                        
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
                            <a class="btn btn-light" href="Donators.php"><i class="ti-home mr-2"></i>Back to Donators Page</a> 
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
                        <h4 class="card-title">Donator Account</h4>
                        <p class="card-description">
                            Create Donator Account
                        </p>
                        <button href="#Bar" class="btn btn-primary mr-2" style="float: right;"
                            data-toggle="collapse">Insert New Donator</button><br /><br /><br />
                        <div id="Bar" class="collapse in">
                            <form class="forms-sample" action="Donators.php" method="post"
                                enctype="multipart/form-data">
                                <!--========== Input Donator Name ==========-->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Donator Name</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="donator_name"
                                            placeholder="Enter Donator Name Eg:- Teh Khadijah" />
                                    </div>

                                    <!--========== Input Donator Email ==========-->
                                    <label class="col-sm-3 col-form-label" align="right">Donator Email</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="donator_email"
                                            placeholder="Enter Donator Email Eg:- Teh Khadijah@kitafund.com" />
                                    </div>
                                </div>

                                <!--========== Input Donator Identity Card ==========-->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Donator Identity Card Number</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="donator_ic"
                                            placeholder="Enter Donator Identity Card Number Eg:- 981205-08-6574" />
                                    </div>

                                    <!--========== Input Donator Phone ==========-->
                                    <label class="col-sm-3 col-form-label" align="right">Donator Phone Number</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="donator_phone"
                                            placeholder="Enter Donator Phone Number Eg:- 011-2707 5974" />
                                    </div>
                                </div>

                                <!--========== Input Name Holder ==========-->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Donator Name Holder</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="donator_name_holder"
                                            placeholder="Enter Donator Name Holder Eg:- Teh Nur Khadijah Fua'at" />
                                    </div>

                                    <!--========== Input Card Number ==========-->
                                    <label class="col-sm-3 col-form-label" align="right">Donator Card Number</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="donator_card_number"
                                            placeholder="Enter Donator Card Number Eg:- 1234-1234-1234-1234" />
                                    </div>
                                </div>

                                <!--========== Input CCV ==========-->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">CCV</label>
                                    <div class="col-sm-3">
                                        <input type="password" class="form-control" name="ccv" 
                                        placeholder="Enter CCV Number Eg:- ***"/>
                                    </div>

                                    <!--========== Input Expired Date ==========-->
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control" name="expired_date" />
                                    </div>

                                    <!--========== Input Amount ==========-->
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white">RM</span>
                                            </div>
                                            <input type="number" class="form-control" step="0.01"
                                                placeholder="Enter Donate Ampunt Eg:-RM10" name="amount">
                                        </div>
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
                        <p class='card-title'>Manage Donators Account</p>
                        <h4>There are currently <b><?php echo "$donator_num" ?> Donators </b>
                            Registration for</h4>
                        <p class='card-description'>
                            Donators List <code>Manage</code>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="donator_name" id="donator_name"
                                                style="height: 40px;">
                                                <option value="">---- Select Donator Name ----</option>
                                                <?php
                                                    $sql = "SELECT donator_name FROM donator";
                                                    $all_donator = mysqli_query($dbc, $sql);

                                                    while ($donators = mysqli_fetch_array(
                                                    $all_donator,MYSQLI_ASSOC)):; 
                                                ?>
                                                <option value="<?php echo $donators["donator_name"];?>">
                                                    <?php echo $donators["donator_name"];?>
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
                                                            <th>Donator Name</th>
                                                            <th>Donator Email</th>
                                                            <th>Donator Identity Card</th>
                                                            <th>Donator Phone</th>
                                                            <th>Donator Amount (RM)</th>
                                                            <th class='text-center'>Donator Date</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="4"></th>
                                                            <th style="text-align:center">TOTAL :</th>
                                                            <th colspan="3"></th>
                                                        </tr>
                                                    </tfoot>
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

        <!-- SCRIPT FOR FETCH RECORD DONATORS -->
        <script type="text/javascript">
        load_data(); // first load
        function load_data(initial_date, final_date, donator_name) {
            var ajax_url = "../Database/Donator/fetch_donator.php";

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
                        "action": "fetch_donator",
                        "initial_date": initial_date,
                        "final_date": final_date,
                        "donator_name": donator_name
                    },
                    "dataSrc": "records"
                },
                "columns": [{
                        "data": "donator_id"
                    },
                    {
                        "data": "donator_name"
                    },
                    {
                        "data": "donator_email"
                    },
                    {
                        "data": "donator_ic"
                    },
                    {
                        "data": "donator_phone"
                    },
                    {
                        "data": "amount"
                    },
                    {
                        "data": "donator_date"
                    },
                    {
                        "data": "counter"
                    }
                ],
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\RM,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column(5)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Total over this page
                    pageTotal = api
                        .column(5, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(5).footer()).html(
                        'RM ' + parseFloat(pageTotal).toFixed(2) +
                        '<br/>( RM ' + parseFloat(total).toFixed(2) + ' total)'
                    );
                },
            });
        }

        // SCRIPT FOR FETCH SUBMIT DATA
        $(document).on('submit', '#updateUser', function(e) {
            e.preventDefault();
            //var tr = $(this).closest('tr');
            var donator_date = $('#DonatorDateField').val();
            var amount = $('#DonatorAmountField').val();
            var expired_date = $('#DonatorExpiredDateField').val();
            var ccv = $('#DonatorCCVField').val();
            var donator_name_holder = $('#DonatorNameHolderField').val();
            var donator_card_number = $('#DonatorCardNumberField').val();
            var donator_phone = $('#DonatorPhoneField').val();
            var donator_ic = $('#DonatorIcField').val();
            var donator_email = $('#DonatorEmailField').val();
            var donator_name = $('#DonatorNameField').val();
            var trid = $('#trid').val();
            var id = $('#id').val();
            if (donator_name != '' && donator_email != '' && donator_ic != '' 
                && donator_phone != '' && donator_card_number !='' 
                && donator_name_holder != '' && ccv != '' && expired_date != '' && amount != ''
                && donator_date != '') {
                $.ajax({
                    url: "../Database/Donator/update_donator.php",
                    type: "post",
                    data: {
                        donator_date: donator_date,
                        amount: amount,
                        expired_date: expired_date,
                        ccv: ccv,
                        donator_name_holder: donator_name_holder,
                        donator_card_number: donator_card_number,
                        donator_phone: donator_phone,
                        donator_ic: donator_ic,
                        donator_name: donator_name,
                        donator_email: donator_email,
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
                                donator_email, donator_name, donator_ic,
                                donator_phone, donator_card_number, donator_name_holder,
                                ccv, donator_date, amount, expired_date,
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
                url: "../Database/Donator/single_data_donator.php",
                data: {
                    id: id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#DonatorDateField').val(json.donator_date);
                    $('#DonatorAmountField').val(json.amount);
                    $('#DonatorExpiredDateField').val(json.expired_date);
                    $('#DonatorCCVField').val(json.ccv);
                    $('#DonatorNameHolderField').val(json.donator_name_holder);
                    $('#DonatorCardNumberField').val(json.donator_card_number);
                    $('#DonatorNameField').val(json.donator_name);
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
                    url: "../Database/Donator/delete_donator.php",
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
            var donator_name = $("#donator_name").val();

            if (initial_date == '' && final_date == '') {
                $('#records').DataTable().destroy();
                load_data("", "", donator_name); // filter immortalize only
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
                        load_data(initial_date, final_date, donator_name);
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
                        <h5 class="modal-title" id="exampleModalLabel">Update Donator Account</h5>
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
                                    <input type="text" class="form-control" id="DonatorNameField" name="donator_name"
                                    placeholder="Name Eg:-Teh Khadijah" disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="mobileField" class="col-md-3 form-label">Card Number</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="DonatorCardNumberField"
                                        placeholder="Card Number Eg:-TehKhadijah@KitaFund" name="donator_card_number">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="cityField" class="col-md-3 form-label">Name Holder</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="DonatorNameHolderField"
                                        placeholder="Name Holder Eg:-Teh Nur Khadijah Fua'at" name="donator_name_holder">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nameField" class="col-md-3 form-label">CCV</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" id="DonatorCCVField" name="ccv"
                                        disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nameField" class="col-md-3 form-label">Expired Date</label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" id="DonatorExpiredDateField"
                                        name="donator_expired_date">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Amount</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="DonatorAmountField" step="0.01"
                                            placeholder="Enter Donate Ampunt Eg:-RM10" name="amount">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="cityField" class="col-md-3 form-label">Donator Date</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="DonatorDateField" name="donator_date"
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