<?php
// Set the page title and include the HTML header:
$page_title = 'Donates';
include 'partials/Header.html';
?>

<style>
.launch {
    height: 50px;
}

.close {
    font-size: 21px;
    cursor: pointer
}

.modal-body {
    height: 300px;
}

.nav-tabs {
    border: none !important
}

.nav-tabs .nav-link.active {
    color: #495057;
    background-color: #fff;
    border-color: #ffffff #ffffff #fff;
    border-top: 3px solid blue !important
}

.nav-tabs .nav-link {
    margin-bottom: -1px;
    border: 1px solid transparent;
    border-top-left-radius: 0rem;
    border-top-right-radius: 0rem;
    border-top: 3px solid #eee;
    font-size: 20px
}

.nav-tabs .nav-link:hover {
    border-color: #e9ecef #ffffff #ffffff
}

.nav-tabs {
    display: table !important;
    width: 100%
}

.nav-item {
    display: table-cell
}

.form-control {
    border-bottom: 1px solid #eee !important;
    border: none;
    font-weight: 600;
    color:#000000
}

.form-control:focus {
    color: #000000;
    background-color: #fff;
    border-color: #8bbafe;
    outline: 0;
    box-shadow: none
}

.inputbox {
    position: relative;
    margin-bottom: 20px;
    width: 100%
}

.inputbox span {
    position: absolute;
    top: 7px;
    left: 11px;
    transition: 0.5s
}

.inputbox i {
    position: absolute;
    top: 13px;
    right: 8px;
    transition: 0.5s;
    color: #3F51B5
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0
}

.inputbox input:focus~span {
    transform: translateX(-0px) translateY(-15px);
    font-size: 12px
}

.inputbox input:valid~span {
    transform: translateX(-0px) translateY(-15px);
    font-size: 12px
}

.pay button {
    height: 47px;
    border-radius: 37px
}
</style>

<!-- Page Header Start -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Donate Now</h2>
            </div>
            <div class="col-12">
                <a href="">Home</a>
                <a href="">Donates</a>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<?php
require ('Database/Connection.php');
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
                            <a class="btn btn-light" href="donate.php"><i class="ti-home mr-2"></i>Back to Donators Page</a>
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
                            <a class="btn btn-light" href="donate.php"><i class="ti-home mr-2"></i>Back to Donators Page</a>                        
                        </div>
                    </div>
                </div>';
        } // End of if ($r) IF.

        mysqli_close($dbc); // Close the database connection.
        // Include the footer and quit the script:
        include 'partials/Footer.php';
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
                            <a class="btn btn-light" href="donate.php"><i class="ti-home mr-2"></i>Back to Donators Page</a> 
                        </div>
                    </div>
                </div>';
    } // End of if (empty($errors)) IF.
    mysqli_close($dbc); // Close the database connection.
    include 'partials/Footer.php';
    exit();

} // End of the main Submit conditional.
?>


<!-- Donate Start -->
<div class="donate" data-parallax="scroll" data-image-src="Assets/img/donate.jpg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="donate-content">
                    <div class="section-header">
                        <p>Donate Now</p>
                        <h2>Let's donate to needy people for better lives</h2>
                    </div>
                    <div class="donate-text">
                        <p>
                            SHARING IS CARING ""
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="donate-form">
                    <form action="donate.php" method="post">
                        <div class="control-group">
                            <input type="text" class="form-control" placeholder="Name" name="donator_name" />
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" placeholder="Email" name="donator_email" />
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" placeholder="Identity Card Number"
                                name="donator_ic" />
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" placeholder="Phone Number" name="donator_phone" />
                        </div>
                        <div class="control-group">
                            <input type="number" class="form-control" placeholder="Donate Amount" name="amount"
                                name="donator_phone" />
                        </div>
                        <div>
                            <button type="button" class="btn btn-custom lauch" data-toggle="modal"
                                data-target="#exampleModal">Donate Now</button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Proceed to Payment...</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation"> <a class="nav-link active"
                                                id="visa-tab" data-toggle="tab" href="#visa" role="tab"
                                                aria-controls="visa" aria-selected="true">
                                                <img src="https://i.imgur.com/sB4jftM.png" width="80"> </a> </li>
                                        <li class="nav-item" role="presentation"> <a class="nav-link" id="paypal-tab"
                                                data-toggle="tab" href="#paypal" role="tab" aria-controls="paypal"
                                                aria-selected="false"> <img src="https://i.imgur.com/yK7EDD1.png"
                                                    width="80"> </a> </li>
                                    </ul>
                                    <div class="modal-body">
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="visa" role="tabpanel"
                                                aria-labelledby="visa-tab">
                                                <div class="mt-4 mx-4">
                                                    <div class="text-center">
                                                        <h5>Credit card</h5>
                                                    </div>
                                                    <div class="form mt-3">
                                                        <div class="inputbox">
                                                            <input type="text" name="donator_name_holder"
                                                                class="form-control" style="color:#000000;">
                                                            <span>Cardholder Name</span>
                                                        </div>
                                                        <div class="inputbox">
                                                            <input type="text" name="donator_card_number" min="1"
                                                                max="999" class="form-control" style="color:#000000;">
                                                            <span>Card Number</span> <i class="fa fa-eye"></i>
                                                        </div>
                                                        <div class="d-flex flex-row">
                                                            <div class="inputbox">
                                                                <input type="date" name="expired_date" min="1" max="999"
                                                                    class="form-control" style="color:#000000;">
                                                                <span>Expiration Date</span>
                                                            </div>
                                                            <div class="inputbox">
                                                                <input type="password" name="ccv" min="1" max="999"
                                                                    class="form-control" style="color:#000000;">
                                                                <span>CVV</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="paypal" role="tabpanel"
                                                aria-labelledby="paypal-tab">
                                                <div class="px-5 mt-5">
                                                    <div class="inputbox"> <input type="text" name="name"
                                                            class="form-control"> <span>Paypal Email
                                                            Address</span> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Donate End -->




<!-- Footer Start -->
<?php
// Set the page title and include the HTML header:
include 'partials/Footer.php';
?>
<!-- Footer End -->

</body>

</html>