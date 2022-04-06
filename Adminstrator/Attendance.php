<!--========== EMPLOYEES ATTENDANCE  ==========-->

<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
$page_title = 'Attendance';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';

// Define the query:
$query = "SELECT a.Attendance_Id, e.Employee_Code, a.Action_Name, a.Attendance_Time, a.Attendance_Message
FROM attendance a, employee e
WHERE a.Employee_Code = e.Profile_Id
ORDER BY  a.Attendance_Id ASC";
$attendance = mysqli_query($dbc, $query);

// Count the number of returned rows:
$attendance_num = mysqli_num_rows($attendance);
?>

<div class='main-panel'>
    <div class='content-wrapper'>
        <div class="row">
            <div class='col-lg-12 grid-margin stretch-card'>
                <div class='card'>
                    <div class='card-body'>
                        <p class='card-title'>Manage Attendance</p>
                        <h4>There are currently <b><?php echo "$attendance_num" ?> Registration</b>
                            for</h4>
                        <p class='card-description'>
                            Attendance Form <code>Submit</code>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="Action_Name" id="Action_Name"
                                                style="height: 40px;">
                                                <option value="">- Please Select Action Name -</option>
                                                <option value="punchIn">Punch In</option>
                                                <option value="punchOut">Punch Out</option>
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
                                                <i class="ti-file btn-icon-append"></i> Add Attendance
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
                                                <table id="records"
                                                    class="display expandable-table dt-responsive display nowrap"
                                                    style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Employee Code</th>
                                                            <th class="text-center">Action Name</th>
                                                            <th class="text-center">Attendance Time</th>
                                                            <th>Attendance Message</th>
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

        <!-- SCRIPT FOR FETCH RECORD ATTENDANCE -->
        <script type="text/javascript">
        load_data(); // first load
        function load_data(initial_date, final_date, Action_Name) {
            var ajax_url = "../Database/Attendance/fetch_attendance.php";

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
                        "action": "fetch_attendance",
                        "initial_date": initial_date,
                        "final_date": final_date,
                        "Action_Name": Action_Name
                    },
                    "dataSrc": "records"
                },
                "columns": [{
                        "data": "Attendance_Id"
                    },
                    {
                        "data": "Employee_Code"
                    },
                    {
                        "data": "Action_Name"
                    },
                    {
                        "data": "Attendance_Time"
                    },
                    {
                        "data": "Attendance_Message"
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
            var Attendance_Message = $('#AttendanceMessageField').val();
            var Attendance_Time = $('#AttendanceTimeField').val();
            var Action_Name = $('#ActionNameField').val();
            var Employee_Code = $('#EmployeeCodeField').val();
            var trid = $('#trid').val();
            var id = $('#id').val();
            if (Employee_Code != '' && Action_Name != '' && Attendance_Time != '' && Attendance_Message != '') {
                $.ajax({
                    url: "../Database/Attendance/update_attendance.php",
                    type: "post",
                    data: {
                        Attendance_Message: Attendance_Message,
                        Attendance_Time: Attendance_Time,
                        Action_Name: Action_Name,
                        Employee_Code: Employee_Code,
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
                                Action_Name, Attendance_Time, Attendance_Message,
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
                url: "../Database/Attendance/single_data_attendance.php",
                data: {
                    id: id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#AttendanceMessageField').val(json.Attendance_Message);
                    $('#AttendanceTimeField').val(json.Attendance_Time);
                    $('#ActionNameField').val(json.Action_Name);
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
                    url: "../Database/Attendance/delete_attendance.php",
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
            var Attendance_Message = $('#AddAttendanceMessageField').val();
            var Action_Name = $('#AddActionNameField').val();
            var Employee_Code = $('#AddEmployeeCodeField').val();
            if (Employee_Code != '' && Action_Name != '' && Attendance_Message != '') {
                $.ajax({
                    url: "../Database/Attendance/add_attendance.php",
                    type: "post",
                    data: {
                        Attendance_Message: Attendance_Message,
                        Action_Name: Action_Name,
                        Employee_Code: Employee_Code
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
            var Action_Name = $("#Action_Name").val();

            if (initial_date == '' && final_date == '') {
                $('#records').DataTable().destroy();
                load_data("", "", Action_Name); // filter immortalize only
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
                        load_data(initial_date, final_date, Action_Name);
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
                        <h5 class="modal-title" id="exampleModalLabel">Update Attendance</h5>
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
                                <label class="col-sm-3 col-form-label">Action Name</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="Action_Name" id="ActionNameField"
                                        style="height: 40px;">
                                        <option value="">- Please Select Action Name -</option>
                                        <option value="punchIn">Punch In</option>
                                        <option value="punchOut">Punch Out</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Attendance
                                    Time</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="AttendanceTimeField"
                                        name="Attendance_Time" disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Attendance
                                    Message</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="AttendanceMessageField"
                                        placeholder="Sorry for late" name="Attendance_Message">
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="wrapper text-center">
                                    <button class="btn btn-primary btn-icon-text" onClick="refreshPage()"><i
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

        <!-- ADD ATTENDANCE MODAL -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Attendance</h5>
                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon"
                            data-bs-dismiss="modal" aria-label="Close"><i class="ti-home"></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="addUser" action="">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Employee Code</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="AddEmployeeCodeField" name="Employee_Code">
                                        <option>- Please Select Employee Code -</option>
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
                                <label class="col-sm-3 col-form-label">Action Name</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="Action_Name" id="AddActionNameField"
                                        style="height: 40px;">
                                        <option value="">- Please Select Action Name -</option>
                                        <option value="punchIn">Punch In</option>
                                        <option value="punchOut">Punch Out</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Attendance
                                    Message</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="AddAttendanceMessageField"
                                        placeholder="Sorry for late" name="Attendance_Message">
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="wrapper text-center">
                                    <button class="btn btn-primary btn-icon-text" onClick="refreshPage()"><i
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