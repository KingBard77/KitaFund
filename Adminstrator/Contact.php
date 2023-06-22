<!--========== CONTACT ==========-->
<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
// Set the page title and include the HTML header:
$page_title = 'Contacts';
include '../partials/Navbar - Adminstrator.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Adminstrator.php';
?>

<?php
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$ip = gethostbyname('www.google.com');

//Load Composer's autoloader
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
?>

<?php
// Define the query:
$query = "SELECT contact_name, contact_email, contact_subject, contact_message, contact_date, contact_remark
FROM contact
WHERE contact_id
ORDER BY contact_id ASC";
$contact = @mysqli_query($dbc, $query);

// Count the number of returned rows:
$contact_num = mysqli_num_rows($contact);

// Set the Contact method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.

    if (empty($_POST['contact_name'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Contact Name.</b>';
    } else {
        $contact_name = trim($_POST['contact_name']);
    }

    if (empty($_POST['contact_email'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Contact Email.</b>';
    } else {
        $contact_email = trim($_POST['contact_email']);
    }

    if (empty($_POST['contact_subject'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Contact Subject.</b>';
    } else {
        $contact_subject = trim($_POST['contact_subject']);
    }

    if (empty($_POST['contact_message'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Contact Message.</b>';
    } else {
        $contact_message = trim($_POST['contact_message']);
    }

    if (empty($_POST['contact_remark'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Contact Remark.</b>';
    } else {
        $contact_remark = trim($_POST['contact_remark']);
    }


    if (empty($errors)) { // If everything's OK.

        // Make the query
        $query = "INSERT INTO contact (contact_name, contact_email, contact_subject, contact_message, contact_remark)
        VALUES ('$contact_name', '$contact_email', '$contact_subject', '$contact_message', '$contact_remark')";
        $result = mysqli_query($dbc, $query); // Run the query.
        
        $lastId = mysqli_insert_id($dbc);

        $msgBody = '
            <h2 align="left">Kita Fund Details</h3>
            <h3 align="left">Donators Details</h3>
            <table border="0" width="80%" cellpadding="5" cellspacing="5">
                <tr>
                    <td colspan="2">Hai Adminstrator, <b>'.$contact_name.'</b> have make a new application of <b>Application Contact Us</b> for the following details:</td>
                </tr>
                <tr>
                    <td width="10%">Subject: </td>
                    <td width="50%">'. $contact_subject.'</td>
                </tr>
                <tr>
                    <td width="10%">Message: </td>
                    <td width="50%">' .$contact_message.'</td>
                </tr>
                <tr>
                    <td colspan="2">* Thank You. Sincerely, Donators KitaFund </td>
                </tr>
            </table>
        ';

        if($query ==true)
        {
            try {
                //Server settings
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'kitafundngohaluan@gmail.com';                     //SMTP username
                $mail->Password   = 'kitafund123';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                //Recipients
                $mail->setFrom('kitafundngohaluan@gmail.com', 'Teh');
                $mail->addAddress('kitafundngohaluan@gmail.com', 'Badrul');     //Add a recipient
            
                //Content
                $mail->isHTML(true);                                 //Set email format to HTML
                $mail->Subject = 'Contact Enquiry';
                $mail->Body    = $msgBody;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                $mail->send();
                //echo 'Message has been sent';
            } catch (Exception $e) {
                //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        
            $data = array(
                'status'=>'true',
            
            );

            echo json_encode($data);
        }
        else
        {
            $data = array(
                'status'=>'false',
            
            );

            echo json_encode($data);
        } 
        
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
                                <p class="mb-0">You are now add a new Contact</p>
                            </div>
                            <a class="btn btn-light" href="Contact.php"><i class="ti-home mr-2"></i>Back to Contact Page</a>
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
                            <a class="btn btn-light" href="Contact.php"><i class="ti-home mr-2"></i>Back to Contact Page</a>                        
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
                            <a class="btn btn-light" href="Contact.php"><i class="ti-home mr-2"></i>Back to Contact Page</a> 
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
                        <h4 class="card-title">Contact Account</h4>
                        <p class="card-description">
                            Create Contact Account
                        </p>
                        <button href="#Bar" class="btn btn-primary mr-2" style="float: right;"
                            data-toggle="collapse">Insert New Contact</button><br /><br /><br />
                        <div id="Bar" class="collapse in">
                            <form class="forms-sample" action="Contact.php" method="post" enctype="multipart/form-data">
                                <!--========== Input Contact Name ==========-->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Contact Name</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="contact_name"
                                            placeholder="Enter Contact Name Eg:- Teh Khadijah" />
                                    </div>

                                    <!--========== Input Contact Email ==========-->
                                    <label class="col-sm-3 col-form-label" align="right">Contact Email</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="contact_email"
                                            placeholder="Enter Contact Email Eg:- Teh Khadijah@kitafund.com" />
                                    </div>
                                </div>

                                <!--========== Input Contact Subject ==========-->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Contact Subject</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="contact_subject">
                                            <option value="">- Please Select Contact Subject -</option>
                                            <option value="Suggestion">Suggestion</option>
                                            <option value="Enquiry">Enquiry</option>
                                            <option value="Complaint">Complaint</option>
                                            <option value="Service Request">Service Requests</option>
                                        </select>
                                    </div>
                                </div>

                                <!--========== Input Contact Phone ==========-->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Contact Message</label>
                                    <div class="col-sm-9">
                                        <input type="textarea" class="form-control" name="contact_message"
                                            placeholder="Enter Contact Message Eg:- Your website is too slow." />
                                    </div>
                                </div>

                                <!--========== Input Contact Remark ==========-->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Contact Remark</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="contact_remark" style="height: 40px;">
                                            <option value="">- Please Select Contact Remark -</option>
                                            <option value="Hold">Hold</option>
                                            <option value="Proceed">Proceed</option>
                                            <option value="Rejected">Rejected</option>
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
                        <p class='card-title'>Manage contacts Account</p>
                        <h4>There are currently <b><?php echo "$contact_num" ?> contacts </b>
                            Registration for</h4>
                        <p class='card-description'>
                            contacts List <code>Manage</code>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="contact_subject" id="contact_subject">
                                                <option value="">- Please Select Contact Subject -</option>
                                                <option value="Suggestion">Suggestion</option>
                                                <option value="Enquiry">Enquiry</option>
                                                <option value="Complaint">Complaint</option>
                                                <option value="Service Request">Service Requests</option>
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
                                                            <th>Contact Name</th>
                                                            <th>Contact Email</th>
                                                            <th>Contact Subject</th>
                                                            <th>Contact Message</th>
                                                            <th class="text-center">Contact Remark</th>
                                                            <th class="text-center">Contact Date</th>
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

        <!-- SCRIPT FOR FETCH RECORD contactS -->
        <script type="text/javascript">
        load_data(); // first load
        function load_data(initial_date, final_date, contact_subject) {
            var ajax_url = "../Database/contact/fetch_contact.php";

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
                        "action": "fetch_contact",
                        "initial_date": initial_date,
                        "final_date": final_date,
                        "contact_subject": contact_subject
                    },
                    "dataSrc": "records"
                },
                "columns": [{
                        "data": "contact_id"
                    },
                    {
                        "data": "contact_name"
                    },
                    {
                        "data": "contact_email"
                    },
                    {
                        "data": "contact_subject"
                    },
                    {
                        "data": "contact_message"
                    },
                    {
                        "data": "contact_remark"
                    },
                    {
                        "data": "contact_date"
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
            var contact_date = $('#contactDateField').val();
            var contact_remark = $('#contactRemarkField').val();
            var contact_message = $('#contactMessageField').val();
            var contact_subject = $('#contactSubjectField').val();
            var contact_email = $('#contactEmailField').val();
            var contact_name = $('#contactNameField').val();
            var trid = $('#trid').val();
            var id = $('#id').val();
            if (contact_name != '' && contact_email != '' && contact_subject != '' &&
                contact_message != '' && contact_date != '' && contact_remark != '') {
                $.ajax({
                    url: "../Database/contact/update_contact.php",
                    type: "post",
                    data: {
                        contact_date: contact_date,
                        contact_remark: contact_remark,
                        contact_message: contact_message,
                        contact_subject: contact_subject,
                        contact_name: contact_name,
                        contact_email: contact_email,
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
                                contact_email, contact_name,
                                contact_subject, contact_message, contact_remark,
                                contact_date,
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
                url: "../Database/contact/single_data_contact.php",
                data: {
                    id: id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#contactDateField').val(json.contact_date);
                    $('#contactRemarkField').val(json.contact_remark);
                    $('#contactMessageField').val(json.contact_message);
                    $('#contactSubjectField').val(json.contact_subject);
                    $('#contactEmailField').val(json.contact_email);
                    $('#contactNameField').val(json.contact_name);
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
                    url: "../Database/contact/delete_contact.php",
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
            var contact_subject = $("#contact_subject").val();

            if (initial_date == '' && final_date == '') {
                $('#records').DataTable().destroy();
                load_data("", "", contact_subject); // filter immortalize only
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
                        load_data(initial_date, final_date, contact_name);
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
                        <h5 class="modal-title" id="exampleModalLabel">Update Contact Account</h5>
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
                                    <input type="text" class="form-control" id="contactNameField" name="contact_name"
                                        placeholder="Contact Name Eg:-Teh Khadijah" disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="mobileField" class="col-md-3 form-label">Email</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="contactEmailField"
                                        placeholder="Contact Email Eg:-TehKhadijah@KitaFund" name="contact_email">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="cityField" class="col-md-3 form-label">Subject</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="contact_subject" id="contactSubjectField">
                                        <option value="">- Please Select Contact Subject -</option>
                                        <option value="Suggestion">Suggestion</option>
                                        <option value="Enquiry">Enquiry</option>
                                        <option value="Complaint">Complaint</option>
                                        <option value="Service Request">Service Requests</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nameField" class="col-md-3 form-label">Messsage</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="contactMessageField"
                                        name="contact_message">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nameField" class="col-md-3 form-label">Remark</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="contact_remark" id="contactRemarkField"
                                        style="height: 40px;">
                                        <option value="">- Please Select Contact Remark -</option>
                                        <option value="Hold">Hold</option>
                                        <option value="Proceed">Proceed</option>
                                        <option value="Reject">Reject</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nameField" class="col-md-3 form-label">Date</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="contactDateField" name="contact_date"
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