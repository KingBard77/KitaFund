<!--========== STOCK CALCULATION  ==========-->
<!-- Plugin css for this page -->

<!-- End plugin css for this page -->
<?php
$page_title = 'Stock Calculation';
include '../partials/Navbar - Employee.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Employee.php';


// Define the query:
$query = "SELECT  s.Stock_Name, s.Selling_Price, s.Quantity_In,
sl.Sales_Id, sl.Quantity_Open, sl.Quantity_Close, sl.Quantity_Balance,
sl.SubTotal, sl.Sales_Date
FROM sales sl, stock s
WHERE s.Stock_Id = sl.Stock_Id 
ORDER BY sl.Sales_Id ASC";
$sales = mysqli_query($dbc, $query);

// Count the number of returned rows:
$sales_num = mysqli_num_rows($sales);

// Define the query:
$query = "SELECT * FROM stock Order by Stock_Name";
$result = $dbc->query($query);

// Set the Stock Inventory method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.

    // Check for Stock Name:
    if (empty($_POST['Stock_Id'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Stock Name.</b>';
    } else {
        $Stock_Name = trim($_POST['Stock_Id']);
    }

    if (empty($_POST['Quantity_Open'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Quantity Open.</b>';
    } else {
        $Quantity_Open = trim($_POST['Quantity_Open']);
    }

    if (empty($_POST['Quantity_Close'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Quantity Close.</b>';
    } else {
        $Quantity_Close = trim($_POST['Quantity_Close']);
    }

    if (empty($_POST['Quantity_Balance'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Quantity Balance.</b>';
    } else {
        $Quantity_Balance = trim($_POST['Quantity_Balance']);
    }

    if (empty($_POST['SubTotal'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Sub Total.</b>';
    } else {
        $SubTotal = trim($_POST['SubTotal']);
    }

    if (empty($_POST['Sales_Date'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Sales Date.</b>';
    } else {
        $Sales_Date = trim($_POST['Sales_Date']);
    }

    if (empty($errors)) { // If everything's OK.
        // Make the query
        $query = "INSERT INTO sales (Stock_Id,  Quantity_Open, Quantity_Close, Quantity_Balance, SubTotal, Sales_Date)
        VALUES ('$Stock_Name',  '$Quantity_Open', '$Quantity_Close', '$Quantity_Balance', '$SubTotal', '$Sales_Date')";
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
                                <p class="mb-0">You are now add a new Stock Calculation for today</p>
                            </div>
                            <a class="btn btn-light" href="Stock_Calculation.php"><i class="ti-home mr-2"></i>Back to Stock Calculation Page</a>
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
                            <a class="btn btn-light" href="Stock_Calculation.php"><i class="ti-home mr-2"></i>Back to Stock Calculation Page</a>                        
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
                            <a class="btn btn-light" href="Stock_Calculation.php"><i class="ti-home mr-2"></i>Back to Stock Calculation Page</a> 
                        </div>
                    </div>
                </div>';
    } // End of if (empty($errors)) IF.
    mysqli_close($dbc); // Close the database connection.
    include '../partials/Footer.html';
    exit();

} // End of the main Submit conditional.

?>



<!--========== MAIN CONTENT ==========-->
<div class='main-panel'>
    <div class='content-wrapper'>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daily Stock Subtotal Calculation</h4>
                        <p class="card-description">
                            Insert New Stock Calculation
                        </p>
                        <button href="#Bar" class="btn btn-primary mr-2" style="float: right;"
                            data-toggle="collapse">Insert New Stock Calculation</button><br /><br /><br />
                        <div id="Bar" class="collapse in">
                            <form class="forms-sample" action="Stock_Calculation.php" method="post">

                                <!--========== Input Stock Name ==========-->
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Stock
                                        Name</label>
                                    <div class="col-sm-9">
                                        <select name="Stock_Id" id="Stock_Name" class="form-control"
                                            onchange="FetchStock(this.value)" required>
                                            <option value="">---- Select Stock Stock Name ----</option>
                                            <?php
                                            if ($result->num_rows > 0 ) {
                                                while ($row = $result->fetch_assoc()) {
                                                echo '<option value='.$row['Stock_Id'].'>'.$row['Stock_Name'].'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!--========== Input In Stock ==========-->
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">In - Stock</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" step="0.01" id="Quantity_In"
                                            placeholder="Insert In - Stock Quantity Eg:-50" name="Quantity_In">
                                    </div>
                                </div>

                                <!--========== Input Open ==========-->
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Open</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" step="0.01" id="Quantity_Open"
                                            placeholder="Insert Open - Stock Quantity Eg:-50" name="Quantity_Open">
                                    </div>
                                </div>

                                <!--========== Input Close ==========-->
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Close</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" step="0.01" id="Quantity_Close"
                                            placeholder="Insert Close - Stock Quantity Eg:-25" name="Quantity_Close">
                                    </div>
                                </div>
                                <!--========== Input Quantity ==========-->
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Quantity</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" step="0.01" id="Quantity_Balance"
                                            placeholder="Insert Balance - Stock Quantity Eg:-25"
                                            name="Quantity_Balance">
                                    </div>
                                </div>

                                <!--========== Input Selling Price ==========-->
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Selling
                                        Price (RM)</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white">RM</span>
                                            </div>
                                            <!--<select name="Selling_Price" id="Selling_Price" class="form-control"
                                                onchange="FetchCity(this.value)" required>
                                                <option>---- Select Selling Price ----</option>
                                            </select>-->
                                            <input type="text" class="form-control" step="0.01" id="Selling_Price"
                                                placeholder="Enter Stock Selling Price Price Eg:- RM 1.20"
                                                name="Selling_Price">
                                        </div>
                                    </div>
                                </div>

                                <!--========== Output SubTotal ==========-->
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">SubTotal
                                        (RM)</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white">RM</span>
                                            </div>
                                            <input type="number" class="form-control" step="0.01" id="SubTotal"
                                                placeholder="Enter Stock SubTotal Price Eg:- RM 1.20" name="SubTotal">
                                        </div>
                                    </div>
                                </div>

                                <!--========== Input Sales Date ==========-->
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Sales
                                        Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                                            name="Sales_Date">
                                    </div>
                                </div>
                                <div class="col-sm-12" align="right">
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset" class="btn btn-light" name="reset">Reset</button>
                                </div>
                            </form>
                        </div>
                        <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i>
                            To retrieve the In-Stock and Selling Price for each stock on a certain day, please select an
                            <b>Stock
                                Name.</b>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class='col-lg-12 grid-margin stretch-card'>
                <div class='card'>
                    <div class='card-body'>
                        <h4 class='card-title'>Daily Stock Subtotal Calculation</h4>
                        <p class='card-description'>
                            Total Daily Subtotal of each Daily Stock
                        </p>
                        <p class='card-description'>
                        <p>There are currently <?php echo" <b> $sales_num </b>";?>Subtotal Sales of each Stock</p>
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
                                            <table class="display expandable-table" id="records" style="width:100%"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Stock Name</th>
                                                        <th class="text-center">In Stock</th>
                                                        <th class="text-center">Open</th>
                                                        <th class="text-center">Close</th>
                                                        <th class="text-center">Quantity</th>
                                                        <th>Selling Price (RM)</th>
                                                        <th>SubTotal (RM) </th>
                                                        <th class="text-center">Sales Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="6"></th>
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

        <!-- JQUERY CALCULATION -->
        <script>
        $(document).ready(function() {
            // Get value on keyup funtion
            $("#Quantity_Open, #Quantity_Close, #Selling_Price, #QuantityOpenField, #QuantityCloseField, #SellingPriceField ")
                .keyup(function() {

                    // Calulcation for Submit Sales Stock
                    var Quantity_Balance = 0;
                    var SubTotal = 0;

                    var Quantity_Open = Number($("#Quantity_Open").val());
                    var Quantity_Close = Number($("#Quantity_Close").val());
                    var Selling_Price = Number($("#Selling_Price").val());

                    var Quantity_Balance = (Quantity_Open) - Quantity_Close;
                    var SubTotal = Quantity_Balance * Selling_Price;

                    $('#Quantity_Balance').val(Quantity_Balance);
                    $('#SubTotal').val(SubTotal);

                    // Calulcation for Update Sales Stock
                    var QuantityBalance = 0;
                    var SubTotal2 = 0;

                    var QuantityOpen = Number($("#QuantityOpenField").val());
                    var QuantityClose = Number($("#QuantityCloseField").val());
                    var SellingPrice = Number($("#SellingPriceField").val());

                    var QuantityBalance = (QuantityOpen) - QuantityClose;
                    var SubTotal2 = QuantityBalance * SellingPrice;

                    $('#QuantityBalanceField').val(QuantityBalance);
                    $('#SubTotalField').val(SubTotal2);

                });
        });

        // SCRIPT FOR FETCH STOCK SELLING PRICE
        function FetchStock(id) {
            $('#Selling_Price').html('');
            $.ajax({
                type: 'post',
                url: '../Database/Sales/Stock_Calculation/stock.php',
                dataType: "json",
                data: {
                    Stock_Id: id
                },
                success: function(data) {
                    if (data.success) {
                        $('#Selling_Price').val(data.selling_price);
                        $('#Quantity_In').val(data.quantity_in);
                        // alert('abc');
                    }
                }

            })
        }
        </script>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
        <!-- Momentjs -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>


        <!-- SCRIPT FOR FETCH RECORD STOCK -->
        <script type="text/javascript">
        load_data(); // first load
        function load_data(initial_date, final_date) {
            var ajax_url = "../Database/Sales/Stock_Calculation/fetch_sales.php";

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
                        "action": "fetch_sales",
                        "initial_date": initial_date,
                        "final_date": final_date
                    },
                    "dataSrc": "records"
                },
                "columns": [{
                        "data": "Sales_Id"
                    },
                    {
                        "data": "Stock_Name"
                    },
                    {
                        "data": "Quantity_In"
                    },
                    {
                        "data": "Quantity_Open"
                    },
                    {
                        "data": "Quantity_Close"
                    },
                    {
                        "data": "Quantity_Balance"
                    },
                    {
                        "data": "Selling_Price"
                    },
                    {
                        "data": "SubTotal"
                    },
                    {
                        "data": "Sales_Date"
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
                        .column(7)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Total over this page
                    pageTotal = api
                        .column(7, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(7).footer()).html(
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
            var Sales_Date = $('#SalesDateField').val();
            var SubTotal = $('#SubTotalField').val();
            var Quantity_Balance = $('#QuantityBalanceField').val();
            var Quantity_Close = $('#QuantityCloseField').val();
            var Quantity_Open = $('#QuantityOpenField').val();
            var trid = $('#trid').val();
            var id = $('#id').val();
            if (Quantity_Open != '' && Quantity_Close != '' && Quantity_Balance != '' && SubTotal != '' &&
                Sales_Date != '') {
                $.ajax({
                    url: "../Database/Sales/Stock_Calculation/update_sales.php",
                    type: "post",
                    data: {
                        Sales_Date: Sales_Date,
                        SubTotal: SubTotal,
                        Quantity_Balance: Quantity_Balance,
                        Quantity_Close: Quantity_Close,
                        Quantity_Open: Quantity_Open,
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
                            row.row("[id='" + trid + "']").data([id, Quantity_Open,
                                Quantity_Close, Quantity_Balance, SubTotal,
                                Sales_Date,
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
                url: "../Database/Sales/Stock_Calculation/single_data_sales.php",
                data: {
                    id: id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#SalesDateField').val(json.Sales_Date);
                    $('#SubTotalField').val(json.SubTotal);
                    $('#SellingPriceField').val(json.Selling_Price);
                    $('#QuantityBalanceField').val(json.Quantity_Balance);
                    $('#QuantityCloseField').val(json.Quantity_Close);
                    $('#QuantityOpenField').val(json.Quantity_Open);
                    $('#StockNameField').val(json.Stock_Name);
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
                    url: "../Database/Sales/Stock_Calculation/delete_sales.php",
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

        // SCRIPT FOR INVOICES CALCULATION
        $(document).ready(function() {
            // Get value on keyup funtion
            $(" #qty1, #qty2, #qty3, #qty4, #qty5, #qty6, #qty7, #qty8 #stafffood, #FoodPanda, #OnlineBanking, #Overhead, #CashInHand")
                .keyup(function() {

                    var Sub_Total, Sub_Total1, Sub_Total2, Sub_Total3, Sub_Total4, Sub_Total5,
                        Sub_Total6, Sub_Total7, Sub_Total8, stafffood,
                        Total_1, Total_2, Total_3, TotalSales, GrandTotal = 0;

                    var Sub_Total = Number($("#Sub_Total").val());
                    var qty1 = Number($("#qty1").val());
                    var qty2 = Number($("#qty2").val());
                    var qty3 = Number($("#qty3").val());
                    var qty4 = Number($("#qty4").val());
                    var qty5 = Number($("#qty5").val());
                    var qty6 = Number($("#qty6").val());
                    var qty7 = Number($("#qty7").val());
                    var qty8 = Number($("#qty8").val());
                    var stafffood = Number($("#stafffood").val());

                    var FoodPanda = Number($("#FoodPanda").val());
                    var OnlineBanking = Number($("#OnlineBanking").val());
                    var Overhead = Number($("#Overhead").val());
                    var CashInHand = Number($("#CashInHand").val());

                    var Sub_Total1 = 1.7 * qty1;
                    var Sub_Total2 = 2.7 * qty2;
                    var Sub_Total3 = 1.8 * qty3;
                    var Sub_Total4 = 3.6 * qty4;
                    var Sub_Total5 = 2.6 * qty5;
                    var Sub_Total6 = 1.2 * qty6;
                    var Sub_Total7 = 1.4 * qty7;
                    var Sub_Total8 = stafffood;

                    //Calculation Total 1 for Stock #Sub_Total
                    Total_1 = Sub_Total

                    //Calculation Total 2 for Reject Stock #Sub Total 2
                    var Total_2 = Sub_Total1 + Sub_Total2 + Sub_Total3 + Sub_Total4 +
                        Sub_Total5 + Sub_Total6 + Sub_Total7 + Sub_Total8;

                    //Calculation Total 3 for (Total_1 - #Total_2)
                    var Total_3 = (Total_1 - Total_2);

                    var TotalSales = FoodPanda + OnlineBanking + Overhead + CashInHand;

                    var GrandTotal = Total_3 - TotalSales;

                    $('#Sub_Total1').val(Sub_Total1);
                    $('#Sub_Total2').val(Sub_Total2);
                    $('#Sub_Total3').val(Sub_Total3);
                    $('#Sub_Total4').val(Sub_Total4);
                    $('#Sub_Total5').val(Sub_Total5);
                    $('#Sub_Total6').val(Sub_Total6);
                    $('#Sub_Total7').val(Sub_Total7);
                    $('#Sub_Total8').val(Sub_Total8);

                    $('#Sub_Total').val(Sub_Total);
                    $('#Total_1').val(Total_1);
                    $('#Total_2').val(Total_2);
                    $('#Total_3').val(Total_3);
                    $('#TotalSales').val(TotalSales);
                    $('#GrandTotal').val(GrandTotal);

                });
        });
        </script>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Stock Sales</h5>
                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon"
                            data-bs-dismiss="modal" aria-label="Close"><i class="ti-home"></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateUser">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="trid" id="trid" value="">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Sales Date</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="SalesDateField" name="Sales_Date"
                                        disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Stock Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="StockNameField" name="Stock_Name"
                                        disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Open</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="QuantityOpenField"
                                            placeholder="Insert Open - Stock Quantity Eg:-50" name="Quantity_Open"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Close</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="QuantityCloseField"
                                            placeholder="Insert Close - Stock Quantity Eg:-50" name="Quantity_Close"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Balance</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="QuantityBalanceField"
                                            placeholder="Insert Balance - Stock Quantity Eg:-50" name="Quantity_Balance"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Selling Price</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="SellingPriceField"
                                            placeholder="Enter Selling Price Eg:-RM1.20" name="Selling_Price"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">SubTotal</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="SubTotalField"
                                            placeholder="Enter SubTotal Eg:-RM1.20" name="SubTotal_Sales" step="0.01">
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