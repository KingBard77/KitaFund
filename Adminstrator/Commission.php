<!--========== EMPLOYEES COMMISSION ==========-->

<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
$page_title = 'Commission';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';

// Define the query:
$query = "SELECT c.Commission_Id, p.Image_Name, e.Employee_Code, c.Commission_Date, c.Basic_Commission, 
c.Earning_Total, c.Claiming, Deduction, c.Bonus, c.Net_Commission, c.Account_No, c.Bank_Name, c.Commission_Message
FROM comission c, employee e, profile p
WHERE c.Employee_Code = e.Profile_Id AND c.Employee_Code = p.Profile_Id
ORDER BY c.Commission_Id ASC";
$commission = mysqli_query($dbc, $query);

// Count the number of returned rows:
$commission_num = mysqli_num_rows($commission);

$sql = "SELECT * FROM employee";
$all_employee = mysqli_query($dbc, $sql);
?>

<script>

</script>

<div class='main-panel'>
    <div class='content-wrapper'>
        <div class="row">
            <div class='col-lg-12 grid-margin stretch-card'>
                <div class='card'>
                    <div class='card-body'>
                        <p class='card-title'>Manage Commission</p>
                        <h4>There are currently <b><?php echo "$commission_num" ?> Registration</b>
                            for</h4>
                        <p class='card-description'>
                            Commission Form <code>Submit</code>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="Commission_Status" id="Commission_Status"
                                                style="height: 40px;">
                                                <option value="">- Please Select Commission Status -</option>
                                                <option value="Unpaid">Unpaid</option>
                                                <option value="Paid">Paid</option>
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
                                                <i class="ti-file btn-icon-append"></i> Add Commission
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-danger" id="error_log"></div>
                                <br />
                                <div class="row">
                                    <div class="col-12">
                                        <div style="width: 100%;">
                                            <!-- Table -->
                                            <div class="table-responsive">
                                                <table class="display expandable-table dt-responsive display nowrap"
                                                    id="records" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th>Employee Code</th>
                                                            <th>Commission Status</th>
                                                            <th>Commission Message </th>
                                                            <th class="text-center">Commission Date</th>
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

        <!-- SCRIPT FOR FETCH RECORD COMMISSION -->
        <script type="text/javascript">
        load_data(); // first load
        function load_data(initial_date, final_date, Commission_Status) {
            var ajax_url = "../Database/Commission/fetch_commission.php";

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
                        "action": "fetch_commission",
                        "initial_date": initial_date,
                        "final_date": final_date,
                        "Commission_Status": Commission_Status
                    },
                    "dataSrc": "records"
                },
                "columns": [{
                        "data": "Commission_Id"
                    },
                    {
                        "data": "Employee_Code"
                    },
                    {
                        "data": "Commission_Status"
                    },
                    {
                        "data": "Commission_Message"
                    },
                    {
                        "data": "Commission_Date"
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
            var Commission_Message = $('#CommissionMessageField').val();
            var Bank_Name = $('#BankNameField').val();
            var Account_No = $('#AccountNoField').val();
            var Net_Commission = $('#NetCommissionField').val();
            var Bonus = $('#BonusField').val();
            var Deduction = $('#DeductionField').val();
            var Claiming = $('#ClaimingField').val();
            var Earning_Total = $('#EarningTotalField').val();
            var Basic_Commission = $('#BasicCommissionField').val();
            var Commission_Date = $('#CommissionDateield').val();
            var Employee_Code = $('#EmployeeCodeField').val();
            var Commission_Status = $('#CommissionStatusField').val();
            var trid = $('#trid').val();
            var id = $('#id').val();
            if (Employee_Code != '' && Commission_Status != '' && Commission_Date != '' && Basic_Commission !=
                '' &&
                Earning_Total != '' && Claiming != '' && Deduction != '' && Bonus != '' && Net_Commission !=
                '' &&
                Account_No != '' && Bank_Name != '' && Commission_Message != '') {
                $.ajax({
                    url: "../Database/Commission/update_commission.php",
                    type: "post",
                    data: {
                        Commission_Message: Commission_Message,
                        Bank_Name: Bank_Name,
                        Account_No: Account_No,
                        Net_Commission: Net_Commission,
                        Bonus: Bonus,
                        Deduction: Deduction,
                        Claiming: Claiming,
                        Earning_Total: Earning_Total,
                        Basic_Commission: Basic_Commission,
                        Commission_Date: Commission_Date,
                        Commission_Status: Commission_Status,
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
                                Commission_Status,
                                Commission_Date, Basic_Commission, Earning_Total,
                                Claiming, Deduction, Bonus, Net_Commission, Account_No,
                                Bank_Name, Commission_Message,
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
                url: "../Database/Commission/single_data_commission.php",
                data: {
                    id: id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#CommissionMessageField').val(json.Commission_Message);
                    $('#BankNameField').val(json.Bank_Name);
                    $('#AccountNoField').val(json.Account_No);
                    $('#NetCommissionField').val(json.Net_Commission);
                    $('#BonusField').val(json.Bonus);
                    $('#DeductionField').val(json.Deduction);
                    $('#ClaimingField').val(json.Claiming);
                    $('#EarningTotalField').val(json.Earning_Total);
                    $('#BasicCommissionField').val(json.Basic_Commission);
                    $('#CommissionDateield').val(json.Commission_Date);
                    $('#CommissionStatusField').val(json.Commission_Status);
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
                    url: "../Database/Commission/delete_commission.php",
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
            var Employee_Code = $('#AddEmployeeCodeField').val();
            var Commission_Status = $('#AddCommissionStatusField').val();
            var Basic_Commission = $('#AddBasicCommissionField').val();
            var Earning_Total = $('#AddEarningTotalField').val();
            var Claiming = $('#AddClaimingField').val();
            var Deduction = $('#AddDeductionField').val();
            var Bonus = $('#AddBonusField').val();
            var Net_Commission = $('#AddNetCommissionField').val();
            var Account_No = $('#AddAccountNoField').val();
            var Bank_Name = $('#AddBankNameField').val();
            var Commission_Message = $('#AddCommissionMessageField').val();
            if (Employee_Code != '' && Commission_Status != '' && Basic_Commission != '' && Earning_Total !=
                '' &&
                Claiming != '' && Deduction != '' && Bonus != '' && Net_Commission != '' &&
                Account_No != '' && Bank_Name != '' && Commission_Message != '') {
                $.ajax({
                    url: "../Database/Commission/add_commission.php",
                    type: "post",
                    data: {
                        Employee_Code: Employee_Code,
                        Commission_Status: Commission_Status,
                        Basic_Commission: Basic_Commission,
                        Earning_Total: Earning_Total,
                        Claiming: Claiming,
                        Deduction: Deduction,
                        Bonus: Bonus,
                        Net_Commission: Net_Commission,
                        Account_No: Account_No,
                        Bank_Name: Bank_Name,
                        Commission_Message: Commission_Message
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
            var Commission_Status = $("#Commission_Status").val();

            if (initial_date == '' && final_date == '') {
                $('#records').DataTable().destroy();
                load_data("", "", Commission_Status); // filter immortalize only
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
                        load_data(initial_date, final_date, Commission_Status);
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
                        <h5 class="modal-title" id="exampleModalLabel">Update Commission</h5>
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
                                <label class="col-sm-3 col-form-label">Commission Status</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="Commission_Status" id="CommissionStatusField">
                                        <option value="">- Please Select Commission Status -</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Unpaid">Unpaid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Basic Paid</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="BasicCommissionField" step="0.01"
                                        placeholder="Enter Basic Paid Eg:-RM1.20"name="Basic_Commission">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Total Earn</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" class="form-control" step="0.01"
                                        placeholder="Enter Total Earn Eg:-RM1.20"id="EarningTotalField">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Claiming</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" class="form-control" step="0.01"
                                        placeholder="Enter Claiming Eg:-RM1.20" id="ClaimingField">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Deduction </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="DeductionField" name="Deduction"
                                        placeholder="Enter Deduction Eg:-RM1.20"step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Bonus</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="BonusField" name="Bonus"
                                        placeholder="Enter Bonus Eg:-RM1.20"step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Net Total</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="NetCommissionField" step="0.01"
                                        placeholder="Enter Net Total Eg:-RM1.20"name="Net_Commission">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Account No</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="AccountNoField" name="Account_No"
                                    placeholder="0000-0000-0000-0000">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Bank Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="BankNameField" 
                                    placeholder="MayBank" name="Bank_Name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Message</label>
                                <div class="col-md-9">
                                    <input type="textarea" class="form-control" id="CommissionMessageField"
                                    placeholder="Save your money wisely" name="Commission_Message">
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

        <!-- ADD COMMISSION MODAL -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Commission</h5>
                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon"
                            data-bs-dismiss="modal" aria-label="Close"><i class="ti-home"></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="addUser" action="">
                            <div class="mb-3 row">
                                <label for="nameField" class="col-sm-3 col-form-label">Employee Code</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="AddEmployeeCodeField" name="Employee_Code">
                                        <option>---- Select Employee Code ----</option>
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
                                <label class="col-sm-3 col-form-label">Commission Status</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="Commission_Status" id="AddCommissionStatusField">
                                        <option value="">- Please Select Commission Status -</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Unpaid">Unpaid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="emailField" class="col-sm-3 col-form-label">Basic Paid</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="AddBasicCommissionField"
                                        placeholder="Enter Basic Paid Eg:-RM1.20"  step="0.01" name="Basic_Commission">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="mobileField" class="col-sm-3 col-form-label">Total Earn</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="AddEarningTotalField" step="0.01"
                                        placeholder="Enter Total Earn Eg:-RM1.20"  name="Earning_Total">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Claiming</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="AddClaimingField" name="Claiming"
                                        placeholder="Enter Claiming Eg:-RM1.20"  step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Deduction </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="AddDeductionField"
                                            name="Deduction" placeholder="Enter Deduction Eg:-RM1.20" 
                                            step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Bonus</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="AddBonusField" name="Bonus"
                                        placeholder="Enter Bonus Eg:-RM1.20" step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Net Total</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="AddNetCommissionField" step="0.01"
                                        placeholder="Enter Net Total Eg:-RM1.20" name="Net_Commission">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Account No</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="0000-0000-0000-0000"
                                        id="AddAccountNoField" name="Account_No">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Bank Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="MayBank" id="AddBankNameField"
                                        name="Bank_Name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Message</label>
                                <div class="col-md-9">
                                    <input type="textarea" class="form-control" placeholder="Save your money wisely"
                                        id="AddCommissionMessageField" name="Commission_Message">
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

        <script>
        // SCRIPT CALCULATION FOR ADD COMMISSION 
        $(document).ready(function() {
            $("#AddBasicCommissionField, #AddEarningTotalField, #AddClaimingField, #AddDeductionField, #AddBonusField")
                .keyup(function() {

                    var total = 0;
                    var Basic = Number($("#AddBasicCommissionField").val());
                    var Earn = Number($("#AddEarningTotalField").val());
                    var Claim = Number($("#AddClaimingField").val());
                    var Deduction = Number($("#AddDeductionField").val());
                    var Bonus = Number($("#AddBonusField").val());
                    var EarnTotal = Basic * 26;
                    var NetCommission = EarnTotal + Claim - Deduction + Bonus;

                    $('#AddNetCommissionField').val(NetCommission);
                    $('#AddEarningTotalField').val(EarnTotal);
                });
        });

        // SCRIPT CALCULATION FOR EDIT COMMISSION 
        $(document).ready(function() {
            // Get value on keyup funtion
            $("#BasicCommissionField, #EarningTotalField, #ClaimingField, #DeductionField, #BonusField")
                .keyup(function() {

                    var total = 0;
                    var Basic = Number($("#BasicCommissionField").val());
                    var Earn = Number($("#EarningTotalField").val());
                    var Claim = Number($("#ClaimingField").val());
                    var Deduction = Number($("#DeductionField").val());
                    var Bonus = Number($("#BonusField").val());
                    var EarnTotal = Basic * 26;
                    var NetCommission = EarnTotal + Claim - Deduction + Bonus;

                    $('#NetCommissionField').val(NetCommission);
                    $('#EarningTotalField').val(EarnTotal);
                });
        });
        </script>

        <!-- Plugin js for this page-->

        <!-- End plugin js for this page-->
        <!-- Custom js for this page-->

        <!-- End custom js for this page-->
        <!--========== INCLUDE FOOTER ==========-->
        <?php include '../partials/Footer.html';?>