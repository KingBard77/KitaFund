<!--========== EMPLOYEES LEAVES ==========-->

<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
// Set the page title and include the HTML header:
$page_title = 'Leaves';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';

?>

<?php
// Define the query:
$query = 'SELECT l.Leave_Id, p.Image_Name, e.Employee_Code, l.Leave_Type, l.From_Date, 
l.To_Date, l.Leave_Message, l.Owner_Remark, l.Leave_Status, l.Apply_Date
FROM leaves l, employee e , profile p 
WHERE l.Employee_Code = e.Profile_Id AND l.Employee_Code = p.Profile_Id 
ORDER BY l.Leave_Id ASC';
$leave = @mysqli_query($dbc, $query);

// Count the number of returned rows:
$leave_num = mysqli_num_rows($leave);
?>
<div class='main-panel'>
    <div class='content-wrapper'>
        <div class="row">
            <div class='col-lg-12 grid-margin stretch-card'>
                <div class='card'>
                    <div class='card-body'>
                        <p class='card-title'>Manage Leaves</p>
                        <h4>There are currently <b><?php echo "$leave_num" ?> Registration</b>
                            for</h4>
                        <p class='card-description'>
                            Medical Leave <code>Submit</code>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="Leave_Status" id="Leave_Status"
                                                style="height: 40px;">
                                                <option value="">- Please Select Leave Status -</option>
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
                                    <div class="text-right">
                                        <div class="btnAdd">
                                            <a href="#!" data-id="" data-bs-toggle="modal"
                                                data-bs-target="#addUserModal"
                                                class="btn btn-outline-success btn-icon-text btn-sm">
                                                <i class="ti-file btn-icon-append"></i> Add Leaves
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 text-danger" id="error_log"></div>
                                <br />
                                <div class="row">
                                    <div class="col-12">
                                        <div style="width: 100%;">
                                            <div class="table-responsive">
                                                <table class="display expandable-table dt-responsive display nowrap"
                                                    id="records" style="width:100%">
                                                    <thead>
                                                        <th class="text-center">#</th>
                                                        <th>Employee Code</th>
                                                        <th>Leave Type</th>
                                                        <th class="text-center">From Date</th>
                                                        <th class="text-center">To Date</th>
                                                        <th>Leave Message</th>
                                                        <th>Owner Remark</th>
                                                        <th>Leave Status</th>
                                                        <th class="text-center">Apply Date</th>
                                                        <th></th>
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

        <!-- SCRIPT FOR FETCH RECORD LEAVES -->
        <script type="text/javascript">
        load_data(); // first load
        function load_data(initial_date, final_date, Leave_Status) {
            var ajax_url = "../Database/Leaves/fetch_leaves.php";

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
                        "action": "fetch_leaves",
                        "initial_date": initial_date,
                        "final_date": final_date,
                        "Leave_Status": Leave_Status
                    },
                    "dataSrc": "records"
                },
                "columns": [{
                        "data": "Leave_Id"
                    },
                    {
                        "data": "Employee_Code"
                    },
                    {
                        "data": "Leave_Type"
                    },
                    {
                        "data": "From_Date"
                    },
                    {
                        "data": "To_Date"
                    },
                    {
                        "data": "Leave_Message"
                    },
                    {
                        "data": "Owner_Remark"
                    },
                    {
                        "data": "Leave_Status"
                    },
                    {
                        "data": "Apply_Date"
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
            var Apply_Date = $('#ApplyDateField').val();
            var Leave_Status = $('#LeaveStatusField').val();
            var Owner_Remark = $('#OwnerRemarkField').val();
            var Leave_Message = $('#LeaveMessageField').val();
            var To_Date = $('#ToDateField').val();
            var From_Date = $('#FromDateField').val();
            var Leave_Type = $('#LeaveTypeField').val();
            var Employee_Code = $('#EmployeeCodeField').val();
            var trid = $('#trid').val();
            var id = $('#id').val();
            if (Employee_Code != '' && Leave_Type != '' && From_Date != '' && To_Date != '' &&
                Leave_Message != '' && Owner_Remark !=
                '' && Leave_Status != '' && Apply_Date != '') {
                $.ajax({
                    url: "../Database/Leaves/update_leaves.php",
                    type: "post",
                    data: {
                        Apply_Date: Apply_Date,
                        Leave_Status: Leave_Status,
                        Owner_Remark: Owner_Remark,
                        Leave_Message: Leave_Message,
                        To_Date: To_Date,
                        From_Date: From_Date,
                        Leave_Type: Leave_Type,
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
                            row.row("[id='" + trid + "']").data([id, Employee_Code,
                                Leave_Type, From_Date, To_Date,
                                Leave_Message, Owner_Remark, Leave_Status,
                                Apply_Date,
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
                url: "../Database/Leaves/single_leaves_data.php",
                data: {
                    id: id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#LeaveTypeField').val(json.Leave_Type);
                    $('#FromDateField').val(json.From_Date);
                    $('#ToDateField').val(json.To_Date);
                    $('#LeaveMessageField').val(json.Leave_Message);
                    $('#OwnerRemarkField').val(json.Owner_Remark);
                    $('#LeaveStatusField').val(json.Leave_Status);
                    $('#ApplyDateField').val(json.Apply_Date);
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
                    url: "../Database/Leaves/delete_leaves.php",
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

        // SCRIPT FOR ADD SINGLE DATA
        $(document).on('submit', '#addUser', function(e) {
            e.preventDefault();
            var Employee_Code = $('#AddEmployeeCodeField').val();
            var Leave_Type = $('#AddLeaveTypeField').val();
            var From_Date = $('#AddFromDateField').val();
            var To_Date = $('#AddToDateField').val();
            var Leave_Message = $('#AddLeaveMessageField').val();
            var Owner_Remark = $('#AddOwnerRemarkField').val();
            var Leave_Status = $('#AddLeaveStatusField').val();
            if (Employee_Code != '' && Leave_Type != '' && From_Date != '' && To_Date != '' &&
                Leave_Message != '' && Owner_Remark != '' && Leave_Status != '') {
                $.ajax({
                    url: "../Database/Leaves/add_leaves.php",
                    type: "post",
                    data: {
                        Employee_Code: Employee_Code,
                        Leave_Type: Leave_Type,
                        From_Date: From_Date,
                        To_Date: To_Date,
                        Leave_Message: Leave_Message,
                        Owner_Remark: Owner_Remark,
                        Leave_Status: Leave_Status
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;
                        if (status == 'true') {
                            mytable = $('#records').DataTable();
                            mytable.draw();
                            $('#addUserModal').modal('hide');
                        } else {
                            alert('failed');
                        }
                    }
                });
            } else {
                alert('Fill all the required fields');
            }
        });

        // SCRIPT FOR FILTER BUTTON
        $("#filter").click(function() {
            var initial_date = $("#initial_date").val();
            var final_date = $("#final_date").val();
            var Leave_Status = $("#Leave_Status").val();

            if (initial_date == '' && final_date == '') {
                $('#records').DataTable().destroy();
                load_data("", "", Leave_Status); // filter immortalize only
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
                        load_data(initial_date, final_date, Leave_Status);
                    }
                }
            }
        });

        // SCRIPT FOR REFRESH BUTTON
        function refreshPage() {
            window.location.reload();
        }
        </script>

        <!-- UPDATE LEAVES MODAL -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Leave</h5>
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
                                <label class="col-sm-3 col-form-label">Leave Type</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="Leave_Type" id="LeaveTypeField">
                                        <option value="">- Please Select Leave Type -</option>
                                        <option value="Holiday Leaves">Holiday Leaves</option>
                                        <option value="Emergency Leaves">Emergency Leaves</option>
                                        <option value="Unpaid Leaves">Unpaid Leaves</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">From Date</label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" id="FromDateField" name="From_Date">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">To Date</label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" id="ToDateField" name="To_Date">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Message</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="LeaveMessageField" name="Leave_Message"
                                    placeholder="My sister had an accident">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Remark</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="OwnerRemarkField" name="Owner_Remark"
                                    placeholder="Get enough rest">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="Leave_Status" id="LeaveStatusField">
                                        <option value="">- Please Select Leave Status -</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Unapproved">Unapproved</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Apply Date</label>
                                <div class="col-md-9">
                                    <input type="datetime" class="form-control" id="ApplyDateField" name="Apply_Date"
                                        disabled>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="wrapper text-center">
                                    <button class="btn btn-primary btn-icon-text"
                                    onClick="refreshPage()"><i
                                            class="ti-file btn-icon-prepend"></i>Submit</button>
                                    <button type="button" class="btn btn-inverse-secondary btn-fw"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- ADD LEAVES MODAL -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Leaves</h5>
                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon"
                            data-bs-dismiss="modal" aria-label="Close"><i class="ti-home"></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="addUser" action="">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Employee Code</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="AddEmployeeCodeField" name="Employee_Code">
                                        <?php
                                            $sql = "SELECT * FROM employee";
                                            $all_employee = mysqli_query($dbc, $sql);
                                        ?>
                                        <?php 
                                            while ($employee = mysqli_fetch_array(
                                            $all_employee,MYSQLI_ASSOC)):; 
                                        ?>
                                        <option value="<?php echo $employee["Profile_Id"];?>">
                                            <?php echo $employee["Employee_Code"];?>
                                        </option>
                                        <?php 
                                        endwhile; 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Leave Type</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="Leave_Type" id="AddLeaveTypeField">
                                        <option value="">- Please Select Leave Type -</option>
                                        <option value="Holiday Leaves">Holiday Leaves</option>
                                        <option value="Emergency Leaves">Emergency Leaves</option>
                                        <option value="Unpaid Leaves">Unpaid Leaves</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">From Date</label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" id="AddFromDateField" name="From_Date">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">To Date</label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" id="AddToDateField" name="To_Date">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Message</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="AddLeaveMessageField"
                                    placeholder="My sister had an accident" name="Leave_Message">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Remark</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="AddOwnerRemarkField"
                                    placeholder="Get enough rest" name="Owner_Remark">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="Leave_Status" id="AddLeaveStatusField">
                                        <option value="">- Please Select Leave Status -</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Unapproved">Unapproved</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="wrapper text-center">
                                    <button class="btn btn-primary btn-icon-text"
                                    onClick="refreshPage()"><i
                                            class="ti-file btn-icon-prepend"></i>Submit</button>
                                    <button type="button" class="btn btn-inverse-secondary btn-fw"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Plugin js for this page-->

        <!-- End plugin js for this page-->
        <!-- Custom js for this page-->

        <!-- End custom js for this page-->
        <?php include '../partials/Footer.html';?>