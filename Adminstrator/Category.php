<!--========== CATEGORY ==========-->

<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
$page_title = 'Category';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';


// Define the query:
$query = "SELECT * FROM category
ORDER BY Category_Id ASC";
$category = mysqli_query($dbc, $query);

// Count the number of returned rows:
$category_num = mysqli_num_rows($category);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.
    // Check for Categories:
    if (empty($_POST['Category_Name'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Category Name.</b>';
    } else {
        $categories = trim($_POST['Category_Name']);
    }

    if (empty($errors)) { // If everything's OK.
        // Make the query
        $query = "INSERT INTO category (Category_name)
            VALUES ('$categories')";
        $result = mysqli_query($dbc, $query); // Run the query.
        if ($result) { // If it ran OK.
            // Print a message:
            echo '
            <!-- SUCCESSFULLY MESSAGE -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                <p class="alert-heading"><h2>Insert Successfully</h2></p>
                                <p><b>Thank You</b> </p>
                                <hr>
                                <p class="mb-0">You are now add a new Category Name for Stock</p>
                            </div>
                            <a class="btn btn-light" href="Category.php"><i class="ti-home mr-2"></i>Back to Category Page</a>
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
                            <a class="btn btn-light" href="Category.php"><i class="ti-home mr-2"></i>Back to Category Page</a>                        
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
                            <a class="btn btn-light" href="Category.php"><i class="ti-home mr-2"></i>Back to Category</a> 
                        </div>
                    </div>
                </div>';
    } // End of if (empty($errors)) IF.
    mysqli_close($dbc); // Close the database connection.
    include '../partials/Footer.html';
    exit();

} // End of the main Submit conditional.
?>
<!--========== ADD CATEGORY ==========-->
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Manage Category</h4>
                        <p class="card-description">
                            Insert All Category
                        </p>
                        <form action="Category.php" method="post">
                            <div class="form-group">
                                <label for="exampleInputName1">Category</label>
                                <input type="text" class="form-control" placeholder="Enter Category Name Eg:-Buns"
                                    name="Category_Name">
                            </div>
                            <div class="col-sm-12" align="right">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="reset" class="btn btn-light" name="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class='col-md-6 stretch-card grid-margin'>
                <div class='card'>
                    <div class='card-body'>
                        <h4 class='card-title'>All Category</h4>
                        <p class='card-description'>
                            Display All Category
                        </p>
                        <p class='card-description'>
                        <p>There are currently <b> <?php echo "$category_num" ?> </b>categories.</p>
                        </p>

                        <div class="table-responsive">
                            <table class="display expandable-table" id="records" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Categories</th>
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


        <!-- SCRIPT FOR FETCH RECORD CATEGORY -->
        <script type="text/javascript">
        load_data(); // first load
        function load_data(initial_date, final_date, Category_Name) {
            var ajax_url = "../Database/Stock/Category/fetch_category.php";

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
                        "Category_Name": Category_Name
                    },
                    "dataSrc": "records"
                },
                "columns": [{
                        "data": "Category_Id"
                    },
                    {
                        "data": "Category_Name"
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
            var Category_Name = $('#CategoryNameField').val();
            var trid = $('#trid').val();
            var id = $('#id').val();
            if (Category_Name != '') {
                $.ajax({
                    url: "../Database/Stock/Category/update_category.php",
                    type: "post",
                    data: {
                        Category_Name: Category_Name,
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
                                Category_Name,
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
                url: "../Database/Stock/Category/single_data_category.php",
                data: {
                    id: id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#CategoryNameField').val(json.Category_Name);
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
                    url: "../Database/Stock/Category/delete_category.php",
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
                        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon"
                            data-bs-dismiss="modal" aria-label="Close"><i class="ti-home"></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateUser">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="trid" id="trid" value="">
                            <div class="mb-3 row">
                                <label for="nameField" class="col-md-3 form-label">Category Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="CategoryNameField"
                                        placeholder="Enter Category Name Eg:-Sausage" name="Category_Name">
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