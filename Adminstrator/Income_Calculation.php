<!--========== INVOICE CALCULATION  ==========-->

<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
// This function outputs theoretical HTML
// for adding ads to a Web page.

$page_title = 'Income';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';

// Define the query:
$query = "SELECT  *
FROM income       
ORDER BY Income_Id ASC";
$income = mysqli_query($dbc, $query);

// Count the number of returned rows:
$income_num = mysqli_num_rows($income);

// Set the Stock Inventory method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.

    // Check for Stock Name:
    if (empty($_POST['Net_Expenses'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Net Expenses.</b>';
    } else {
        $Net_Expenses = trim($_POST['Net_Expenses']);
    }

    if (empty($_POST['Net_Income'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Net Income.</b>';
    } else {
        $Net_Income = trim($_POST['Net_Income']);
    }

    if (empty($_POST['Income_Date'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Income Date.</b>';
    } else {
        $Income_Date = trim($_POST['Income_Date']);
    }

    if (empty($errors)) { // If everything's OK.
        // Make the query
        $query = "INSERT INTO income (Net_Expenses,  Net_Income, Income_Date)
        VALUES ('$Net_Expenses',  '$Net_Income',  '$Income_Date')";
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
                                <p class="mb-0">You are now add a new Income Calculation for today</p>
                            </div>
                            <a class="btn btn-light" href="Income_Calculation.php"><i class="ti-home mr-2"></i>Back to Income Calculation Page</a>
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
                            <a class="btn btn-light" href="Income_Calculation.php"><i class="ti-home mr-2"></i>Back to Income Calculation Page</a>                        
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
                            <a class="btn btn-light" href="Income_Calculation.php"><i class="ti-home mr-2"></i>Back to Income Calculation Page</a> 
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
        <div class="row">
            <div class='col-lg-12 grid-margin stretch-card'>
                <div class='card'>
                    <div class='card-body'>
                        <h4 class='card-title'>Daily Income Calculation</h4>
                        <p class='card-description'>
                            Total Daily Income
                        </p>
                        <p class='card-description'>
                        <p>There are currently <?php echo" <b> $income_num </b>";?>Total Income</p>
                        </p>
                        <button href="#Bar" class="btn btn-primary mr-2" style="float: right;"
                            data-toggle="collapse">Insert New Income</button><br /><br /><br />
                        <div id="Bar" class="collapse in">
                            <form action="Income_Calculation.php" method="POST" class="">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <!-- Table -->
                                        <div class="table-responsive">
                                            <table class="table table-hover" style="width:100%" style="width:100%">
                                                <thead>
                                                    <thead>
                                                        <tr>
                                                            <th>INCOME DATE </th>
                                                            <th>TOTAL SALES (RM)</th>
                                                            <th>NET EXPENSES (RM)</th>
                                                            <th class="text-center">NET INCOME (RM)</th>
                                                        </tr>
                                                    </thead>
                                                </thead>
                                                <tbody>
                                                    <!--========== INCOME ==========-->
                                                    <tr>
                                                        <td>
                                                            <input type="date" id="Income_Date"
                                                                value="<?php echo date('Y-m-d'); ?>" name="Income_Date"
                                                                class="form-control form-control-sm"
                                                                onchange="FetchTotalInvoice(this.value) ; FetchNetExpenses(this.value)" />
                                                        </td>
                                                        <td>
                                                            <input type="number" id="Total_Sales" name="Total_Sales"
                                                                step="0.01" placeholder="Enter Total Sales Eg:- RM 1.20"
                                                                class="form-control form-control-sm" />
                                                        </td>
                                                        <td>
                                                            <input type="number" id="Net_Expenses" name="Net_Expenses"
                                                                step="0.01"
                                                                placeholder="Enter Net Expenses Eg:- RM 1.20"
                                                                class="form-control form-control-sm" />
                                                        </td>
                                                        <td>
                                                            <input type="number" id="Net_Income" name="Net_Income"
                                                                step="0.01" class="form-control form-control-sm" />
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-12" align="right">
                                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                            <button type="reset" class="btn btn-light" name="reset">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i>
                            To retrieve the Total Sales and Net Expenses for each sales on a certain day, please select
                            an
                            <b>Income
                                Date.</b>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class='col-lg-12 grid-margin stretch-card'>
                <div class='card'>
                    <div class='card-body'>
                        <h4 class='card-title'>Daily Income Calculation</h4>
                        <p class='card-description'>
                            Total Daily Income
                        </p>
                        <p class='card-description'>
                        <p>There are currently <?php echo" <b> $income_num </b>";?>Total Income</p>
                        </p>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control" id="start_date"
                                                placeholder="Start Date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control" id="end_date"
                                                placeholder="End Date">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button name="filter" id="filter"
                                        class="btn btn-outline-info btn-sm">Filter</button>
                                    <button id="reset-btn" onClick="refreshPage()"
                                        class="btn btn-outline-warning btn-sm">Reset</button>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <!-- Table -->
                                        <div class="table-responsive">
                                            <table class="display expandable-table" id="records" style="width:100%">
                                                <thead>
                                                    <th>#</th>
                                                    <th>Net Expenses (RM)</th>
                                                    <th class="text-center">Net Income (RM)</th>
                                                    <th class="text-center">Income Date</th>
                                                    <th></th>
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


        <!-- SCRIPT FOR FETCH RECORD INVOME -->
        <script type="text/javascript">
        load_data(); // first load
        function load_data(initial_date, final_date) {
            var ajax_url = "../Database/Sales/Income_Calculation/fetch_income.php";

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
                        "action": "fetch_income",
                        "initial_date": initial_date,
                        "final_date": final_date
                    },
                    "dataSrc": "records"
                },
                "columns": [{
                        "data": "Income_Id"
                    },
                    {
                        "data": "Net_Expenses"
                    },
                    {
                        "data": "Net_Income"
                    },
                    {
                        "data": "Income_Date"
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
            var Income_Date = $('#IncomeDatehField').val();
            var Net_Income = $('#NetIncomeField').val();
            var Net_Expenses = $('#NetExpensesField').val();
            var trid = $('#trid').val();
            var id = $('#id').val();
            if (Net_Expenses != '' && Net_Income != '' && Income_Date != '') {
                $.ajax({
                    url: "../Database/Sales/Income_Calculation/update_income.php",
                    type: "post",
                    data: {
                        Income_Date: Income_Date,
                        Net_Income: Net_Income,
                        Net_Expenses: Net_Expenses,
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
                            row.row("[id='" + trid + "']").data([id, Net_Expenses,
                                Net_Income, Net_Income,
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
                url: "../Database/Sales/Income_Calculation/single_data_income.php",
                data: {
                    id: id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#NetExpensesField').val(json.Net_Expenses);
                    $('#NetIncomeField').val(json.Net_Income);
                    $('#IncomeDateField').val(json.Income_Date);
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
                    url: "../Database/Sales/Income_Calculation/delete_income.php",
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
        $(document).ready(function() {
            $("filter").click(function() {
                $('#records').DataTable().ajax.reload();
            });
        });

        // SCRIPT FOR FILTER BUTTON
        $("#filter").click(function() {
            var initial_date = $("#start_date").val();
            var final_date = $("#end_date").val();

            if (initial_date == '' && final_date == '') {
                $('#records').DataTable().destroy();
                load_data("", ""); // filter immortalize only
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
                        load_data(initial_date, final_date);
                    }
                }
            }
        });

        // SCRIPT FOR REFRESH BUTTON
        function refreshPage() {
            window.location.reload();
        }

        // SCRIPT FOR FETCH TOTAL SALES
        function FetchTotalInvoice(date) {
            // alert(date);   
            $.ajax({
                type: 'post',
                url: '../Database/Sales/Income_Calculation/fetch_total_invoice.php',
                dataType: "json",
                data: {
                    date: date
                },
                success: function(data) {
                    if (data.success) {
                        $('#Total_Sales').val(data.Total_Sales);
                        // Sub_Total
                    }
                }

            })
        }

        // SCRIPT FOR FETCH NET EXPENSES
        function FetchNetExpenses(date) {
            // alert(date);   
            $.ajax({
                type: 'post',
                url: '../Database/Sales/Income_Calculation/fetch_total_expenses.php',
                dataType: "json",
                data: {
                    date: date
                },
                success: function(data) {
                    if (data.success) {
                        $('#Net_Expenses').val(data.Net_Expenses);
                        // Sub_Total
                    }
                }

            })
        }

        // SCRIPT FOR INCOME CALCULATION
        $(document).ready(function() {
            // Get value on keyup funtion
            $(" #Net_Expenses, #Total_Sales")
                .keyup(function() {

                    var Net_Income = 0;

                    var Net_Expenses = Number($("#Net_Expenses").val());
                    var Total_Sales = Number($("#Total_Sales").val());

                    //Calculation Net Income
                    var Net_Income = Total_Sales - Net_Expenses;

                    $('#Net_Income').val(Net_Income);

                });
        });
        </script>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Income</h5>
                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon"
                            data-bs-dismiss="modal" aria-label="Close"><i class="ti-home"></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateUser">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="trid" id="trid" value="">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Income Date</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="IncomeDateField" name="Income_Date"
                                        disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Net Expenses</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="NetExpensesField"
                                            placeholder="Enter Net Expenses Eg:- RM 1.20" name="Net_Expenses"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Net Income</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="NetIncomeField" name="Net_Income"
                                            step="0.01">
                                    </div>
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

        <!--========== INCLUDE FOOTER ==========-->
        <?php include '../partials/Footer.html';?>