<!--========== STOCK ==========-->
<?php
$page_title = 'Stock';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';
// Define the query:
$sql = "SELECT * FROM category";
$all_categories = mysqli_query($dbc, $sql);

// Set the Stock Inventory method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.

    // Check for Stock Name:
    if (empty($_POST['Stock_Name'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Stock Name.</b>';
    } else {
        $Stock_Name = trim($_POST['Stock_Name']);
    }

    if (empty($_POST['Quantity_In'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Quantity In.</b>';
    } else {
        $Quantity_In = trim($_POST['Quantity_In']);
    }

    if (empty($_POST['Buying_Price'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Buying Price.</b>';
    } else {
        $Buying_Price = trim($_POST['Buying_Price']);
    }

    if (empty($_POST['Selling_Price'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Selling Price.</b>';
    } else {
        $Selling_Price = trim($_POST['Selling_Price']);
    }

    if (empty($_POST['Category_Id'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Category Name.</b>';
    } else {
        $Category_Name = trim($_POST['Category_Id']);
    }

    if (empty($errors)) { // If everything's OK.
        // Make the query
        $query = "INSERT INTO stock (Stock_Name, Quantity_In, Buying_Price, Selling_Price, Category_Id)
		VALUES ('$Stock_Name', '$Quantity_In', '$Buying_Price', '$Selling_Price', '$Category_Name')";
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
                                <p class="mb-0">You are now add a new Stock In Quantity</p>
                            </div>
                            <a class="btn btn-light" href="Stock.php"><i class="ti-home mr-2"></i>Back to Stock Page</a>
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
                            <a class="btn btn-light" href="Stock.php"><i class="ti-home mr-2"></i>Back to Stock Page</a>                        
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
                            <a class="btn btn-light" href="Stock.php"><i class="ti-home mr-2"></i>Back to Stock Page</a> 
                        </div>
                    </div>
                </div>';
    } // End of if (empty($errors)) IF.
    mysqli_close($dbc); // Close the database connection.
    include '../partials/Footer.html';
    exit();

} // End of the main Submit conditional.

// Define the query:
$query = "SELECT s.Stock_Id, s.Stock_Name, s.Quantity_In, s.Buying_Price, s.Selling_Price, s.Stock_Date,
        c.Category_Name
        FROM stock s, category c
        WHERE s.Category_id = c.Category_id
        ORDER BY s.Stock_Id ASC";
$stock = mysqli_query($dbc, $query);

// Count the number of returned rows:
$stock_num = mysqli_num_rows($stock);

?>

<!--========== MAIN CONTENT ==========-->
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Manage Stock</h4>
                        <p class="card-description">
                            Insert New Stock
                        </p>
                        <button href="#Bar" class="btn btn-primary mr-2" style="float: right;"
                            data-toggle="collapse">Insert New Stock</button><br /><br /><br />
                        <div id="Bar" class="collapse in">
                            <form class="forms-sample" action="Stock.php" method="post">
                                <!--========== Input Stock Name ==========-->
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Stock
                                        Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Enter Stock Name"
                                            name="Stock_Name">
                                    </div>
                                </div>

                                <!--========== Input Category ==========-->
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="Category_Id">
                                            <option value="">---- Select Stock Category ----</option>
                                            <?php 
                                                while ($category = mysqli_fetch_array(
                                                $all_categories,MYSQLI_ASSOC)):; 
                                            ?>
                                            <option value="<?php echo $category["Category_Id"];?>">
                                                <?php echo $category["Category_Name"];?>
                                            </option>
                                            <?php 
                                                endwhile; 
                                                // While loop must be terminated
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!--========== Input Quantity_In ==========-->
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">In -
                                        Stock</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control"
                                            placeholder="Insert In - Stock Quantity Eg:-25" name="Quantity_In">
                                    </div>
                                </div>
                                <!--========== Input Buying_Price ==========-->
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Buying
                                        Price (RM)</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white">RM</span>
                                            </div>
                                            <input type="number" class="form-control" step="0.01"
                                                placeholder="Enter Stock Buying Price Eg:- RM 1.20" name="Buying_Price">
                                        </div>
                                    </div>
                                </div>

                                <!--========== Input Selling_Price ==========-->
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Selling
                                        Price (RM)</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white">RM</span>
                                            </div>
                                            <input type="number" class="form-control" step="0.01"
                                                placeholder="Enter Stock Selling Price Eg:- RM 1.20"
                                                name="Selling_Price">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class='row'>
            <div class='col-lg-12 grid-margin stretch-card'>
                <div class='card'>
                    <div class='card-body'>
                        <h4 class='card-title'>All Stock</h4>
                        <p class='card-description'>
                            Display All Stock
                        </p>
                        <p class='card-description'>
                        <p>There are currently <b> <?php echo "$stock_num" ?> </b>Stock.</p>
                        </p>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <select class="form-control" id="Stock_Name" name="Stock_Name"
                                                style="height: 40px;">
                                                <option value="">---- Select Stock Category Filtering ----</option>
                                                <?php
                                                    $sql = "SELECT * FROM stock";
                                                    $all_categories = mysqli_query($dbc, $sql);
                                                ?>
                                                <?php 
                                                    while ($category = mysqli_fetch_array(
                                                    $all_categories,MYSQLI_ASSOC)):; 
                                                ?>
                                                <option value="<?php echo $category["Stock_Name"];?>">
                                                    <?php echo $category["Stock_Name"];?>
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
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="display expandable-table" id="records" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th>Stock Name</th>
                                                        <th>Category Name</th>
                                                        <th>In - Stock</th>
                                                        <th>Buying Price (RM)</th>
                                                        <th>Selling Price (RM)</th>
                                                        <th class="text-center">TimeStamp</th>
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


        <!-- SCRIPT FOR FETCH RECORD STOCK -->
        <script type="text/javascript">
        load_data(); // first load
        function load_data(initial_date, final_date, Stock_Name) {
            var ajax_url = "../Database/Stock/Stock/fetch_stock.php";

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
                    [0, "asc"]
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
                        "action": "fetch_stock",
                        "initial_date": initial_date,
                        "final_date": final_date,
                        "Stock_Name": Stock_Name
                    },
                    "dataSrc": "records"
                },
                "columns": [{
                        "data": "Stock_Id"
                    },
                    {
                        "data": "Stock_Name",
                    },
                    {
                        "data": "Category_Name"
                    },
                    {
                        "data": "Quantity_In"
                    },
                    {
                        "data": "Buying_Price"
                    },
                    {
                        "data": "Selling_Price"
                    },
                    {
                        "data": "Stock_Date"
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
            var Stock_Date = $('#StockDateField').val();
            var Buying_Price = $('#BuyingPriceField').val();
            var Selling_Price = $('#SellingPriceField').val();
            var Quantity_In = $('#QuantityInField').val();
            var Category_Name = $('#CategoryNameField').val();
            var Stock_Name = $('#StockNameField').val();
            var trid = $('#trid').val();
            var id = $('#id').val();
            if (Stock_Name != '' && Category_Name != '' && Quantity_In != '' &&
                Selling_Price != '' && Buying_Price != '' && Stock_Date != '') {
                $.ajax({
                    url: "../Database/Stock/Stock/update_stock.php",
                    type: "post",
                    data: {
                        Stock_Date: Stock_Date,
                        Buying_Price: Buying_Price,
                        Selling_Price: Selling_Price,
                        Quantity_In: Quantity_In,
                        Category_Name: Category_Name,
                        Stock_Name: Stock_Name,
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
                                Stock_Name, Category_Name,
                                Quantity_In, Selling_Price, Buying_Price,
                                Stock_Date,
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
                url: "../Database/Stock/Stock/single_data_stock.php",
                data: {
                    id: id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#StockDateField').val(json.Stock_Date);
                    $('#BuyingPriceField').val(json.Buying_Price);
                    $('#SellingPriceField').val(json.Selling_Price);
                    $('#QuantityInField').val(json.Quantity_In);
                    $('#CategoryNameField').val(json.Category_Name);
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
                    url: "../Database/Stock/Stock/delete_stock.php",
                    data: {
                        id: id
                    },
                    type: "post",
                    success: function(data) {
                        var json = JSON.parse(data);
                        status = json.status;
                        if (status == 'success') {
                            //table.fnDeleteRow( table.$('#' + id)[0] );
                            //$("#example tbody").find(id).remove();
                            //table.row($(this).closest("tr")) .remove();
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
            var initial_date = $("#initial_date").val();
            var final_date = $("#final_date").val();
            var Stock_Name = $("#Stock_Name").val();

            if (initial_date == '' && final_date == '') {
                $('#records').DataTable().destroy();
                load_data("", "", Stock_Name); // filter immortalize only
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
                        load_data(initial_date, final_date, Category_Name);
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
                        <h5 class="modal-title" id="exampleModalLabel">Update Stock</h5>
                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon"
                            data-bs-dismiss="modal" aria-label="Close"><i class="ti-home"></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateUser">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="trid" id="trid" value="">
                            <div class="mb-3 row">
                                <label for="nameField" class="col-md-3 form-label">Stock Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="StockNameField" 
                                    placeholder="Enter Stock Name" name="Stock_Name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nameField" class="col-md-3 form-label">Category Name</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="Category_Name" id="CategoryNameField">
                                        <option value="">---- Select Employee Category ----</option>
                                        <?php
                                            $sql = "SELECT * FROM category";
                                            $all_categories = mysqli_query($dbc, $sql);

                                            while ($category = mysqli_fetch_array(
                                            $all_categories,MYSQLI_ASSOC)):; 
                                        ?>
                                        <option value="<?php echo $category["Category_Name"];?>">
                                            <?php echo $category["Category_Name"];?>
                                        </option>
                                        <?php 
                                            endwhile; 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nameField" class="col-md-3 form-label">Quantity In</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" id="QuantityInField" name="Quantity_In"
                                    placeholder="Insert In - Stock Quantity Eg:-25">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nameField" class="col-md-3 form-label">Buying Price</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="BuyingPriceField" step="0.01"
                                        placeholder="Enter Buying Price Eg:- RM 1.20" name="Buying_Price">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nameField" class="col-md-3 form-label">Selling Price</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="SellingPriceField" step="0.01"
                                        placeholder="Enter Selling Price Eg:- RM 1.20"name="Selling_Price">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nameField" class="col-md-3 form-label">Stock Date</label>
                                <div class="col-md-9">
                                    <input type="datetime" class="form-control" id="StockDateField" name="Stock_Date"
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



        <!--========== INCLUDE FOOTER ==========-->
        <?php include '../partials/Footer.html';?>