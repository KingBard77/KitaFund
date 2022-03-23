<!--========== EMPLOYEES ORDERING  ==========-->

<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
$page_title = 'Ordering Employee';
include '../partials/Navbar - Employee.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Employee.php';

// Define the query:
$query = "SELECT *
FROM ordering o, employee e, profile p
WHERE o.Employee_Code = e.Profile_Id 
AND o.Employee_Code = p.Profile_Id
AND e.Employee_Code ='$id'
ORDER BY  o.Order_Id ASC";
$ordering = mysqli_query($dbc, $query);

// Count the number of returned rows:
$ordering_num = mysqli_num_rows($ordering);
?>

<div class='main-panel'>
    <div class='content-wrapper'>
        <div class="row">
            <div class='col-lg-12 grid-margin stretch-card'>
                <div class='card'>
                    <div class='card-body'>
                        <p class='card-title'>Manage Order</p>
                        <h4>There are currently <b><?php echo "$ordering_num" ?> Ordering</b>
                            Registration for</h4>
                        <p class='card-description'>
                            Ordering Form <code>Submit</code>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="Order_Status" id="Order_Status"
                                                style="height: 40px;">
                                                <option value="">- Please Select Order Status -</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Purchase">Purchase</option>
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
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="records" class="display expandable-table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Order Status</th>
                                                        <th class="text-center">Order Date</th>
                                                        <th class="text-center">Employee Code</th>
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

        <!-- SCRIPT FOR FETCH RECORD ORDERING -->
        <script type="text/javascript">
        load_data(); // first load
        function load_data(initial_date, final_date, Order_Status) {
            var ajax_url = "../Database/Record/Stock/Ordering/fetch_ordering.php";

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
                        "action": "fetch_ordering",
                        "initial_date": initial_date,
                        "final_date": final_date,
                        "Order_Status": Order_Status
                    },
                    "dataSrc": "records"
                },
                "columns": [{
                        "data": "Order_Id"
                    },
                    {
                        "data": "Order_Status"
                    },
                    {
                        "data": "Order_Date"
                    },
                    {
                        "data": "Employee_Code"
                    },
                    {
                        "data": "counter"
                    }
                ]
            });
        }

        // SCRIPT FOR FETCH SINGLE DATA
        $('#records').on('click', '.editbtn ', function(event) {
            var table = $('#records').DataTable();
            var trid = $(this).closest('tr').attr('id');
            // console.log(selectedRow);
            var id = $(this).data('id');
            $('#exampleModal').modal('show');

            $.ajax({
                url: "../Database/Record/Stock/Ordering/single_data_ordering.php",
                data: {
                    id: id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#OrderDateField').val(json.Order_Date);
                    $('#OrderStatusField').val(json.Order_Status);
                    $('#EmployeeCodeField').val(json.Employee_Code);
                    $('#TotalExpensesField').val(json.TotalExpenses);
                    $('#QuantitiesField').val(json.Quantities);
                    $('#DescriptionField').val(json.Descriptions);
                    $('#id').val(id);
                    $('#trid').val(trid);
                }
            })

            $.ajax({
                url: "../Database/Record/Stock/Ordering/ordering_receipt.php?id="+id,
                type: 'get',
                success: function(data) {
                    $("#order-list").html(data);
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
                    url: "../Database/Stock/Ordering/delete_ordering.php",
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
            var initial_date = $("#initial_date").val();
            var final_date = $("#final_date").val();
            var Order_Status = $("#Order_Status").val();

            if (initial_date == '' && final_date == '') {
                $('#records').DataTable().destroy();
                load_data("", "", Order_Status); // filter immortalize only
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
                        load_data(initial_date, final_date, Order_Status);
                    }
                }
            }
        });

        // SCRIPT FOR REFRESH BUTTON
        function refreshPage() {
            window.location.reload();
        }

        // SCRIPT FOR PRINT BUTTON
        function printDiv() {
            var divContents = document.getElementById("GFG").innerHTML;
            var a = window.open('', '', 'height=1920, width=1500');
            a.document.write('<html>');
            a.document.write('<body > <h1>Material Receipt <br>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
        </script>

        <!-- VIEW ORDERING MODAL -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View Ordering</h5>
                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon"
                            data-bs-dismiss="modal" aria-label="Close"><i class="ti-home"></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateUser">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="trid" id="trid" value="">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Employee Code</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="EmployeeCodeField" name="Employee_Code"
                                        disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Order Status</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="Order_Status" id="OrderStatusField" disabled>
                                        <option value="">- Please Select Order Status -</option>
                                        <option value="Purchase">Purchase</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Order Date</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="OrderDateField" name="Order_Date"
                                        disabled>
                                </div>
                            </div>
                            <div id="order-list">
                            </div>
                            <div class="text-right">
                                <button class="btn btn-info mr-2" onclick="printDiv()"><i
                                        class="ti-printer me-1"></i> &nbsp;Print</a></button>
                                <button type="submit" class="btn btn-primary btn-icon-text" onClick="refreshPage()"><i
                                        class="ti-file btn-icon-prepend"></i>Save</button>
                                <button type="button" class="btn btn-inverse-secondary btn-fw"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../partials/Footer.html';?>