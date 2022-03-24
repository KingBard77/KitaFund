<!--========== INVOICE CALCULATION  ==========-->

<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
// This function outputs theoretical HTML
// for adding ads to a Web page.

$page_title = 'Invoice Calculation';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';

// Define the Invoice Query:
$query = "SELECT  *
FROM invoice        
ORDER BY Invoice_Id ASC";
$invoice = mysqli_query($dbc, $query);

// Count the number of returned rows:
$invoice_num = mysqli_num_rows($invoice);

// Define the query:
$query = "SELECT * FROM stock Order by Stock_Name";
$result = $dbc->query($query);

// Set the Stock Inventory method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.

    // Check for Stock Name:
    if (empty($_POST['Total'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Total.</b>';
    } else {
        $Total = trim($_POST['Total']);
    }

    if (empty($_POST['Overhead'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Overhead.</b>';
    } else {
        $Overhead = trim($_POST['Overhead']);
    }

    if (empty($_POST['Total_Cash'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Total Cash.</b>';
    } else {
        $Total_Cash = trim($_POST['Total_Cash']);
    }

    if (empty($_POST['Total_Sales'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Total Sales.</b>';
    } else {
        $Total_Sales = trim($_POST['Total_Sales']);
    }

    if (empty($_POST['Invoice_Message'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Invoice Message.</b>';
    } else {
        $Invoice_Message = trim($_POST['Invoice_Message']);
    }

    if (empty($_POST['Invoice_Date'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Invoice Date.</b>';
    } else {
        $Invoice_Date = trim($_POST['Invoice_Date']);
    }

    if (empty($errors)) { // If everything's OK.
        // Make the query
        $query = "INSERT INTO invoice (Total,  Overhead, Total_Cash, Total_Sales, Invoice_Message, Invoice_Date)
        VALUES ('$Total',  '$Overhead', '$Total_Cash', '$Total_Sales', '$Invoice_Message', '$Invoice_Date')";
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
                                <p class="mb-0">You are now add a new Invoice Calculation for today</p>
                            </div>
                            <a class="btn btn-light" href="Invoice_Calculation.php"><i class="ti-home mr-2"></i>Back to Invoice Calculation Page</a>
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
                            <a class="btn btn-light" href="Invoice_Calculation.php"><i class="ti-home mr-2"></i>Back to Invoice Calculation Page</a>                        
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
                            <a class="btn btn-light" href="Invoice_Calculation.php"><i class="ti-home mr-2"></i>Back to Invoice Calculation Page</a> 
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
                        <h4 class='card-title'>Daily Invoice Calculation</h4>
                        <p class='card-description'>
                            Insert New Invoice Calculation
                        </p>
                        <button href="#Bar" class="btn btn-primary mr-2" style="float: right;"
                            data-toggle="collapse">Insert New Invoice Calculation</button><br /><br /><br />
                        <div id="Bar" class="collapse in">
                            <form action="Invoice_Calculation.php" method="POST" class="">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <!-- Table -->
                                        <div class="table-responsive">
                                            <table class="table table-hover" style="width:100%" style="width:100%">
                                                <thead>
                                                    <thead>
                                                        <tr>
                                                            <th>STOCK LIST</th>
                                                            <th>SELLING PRICE (RM)</th>
                                                            <th class="text-center">SUBTOTAL</th>
                                                            <th class="text-center">TOTAL (RM)</th>
                                                        </tr>
                                                    </thead>
                                                </thead>
                                                <tbody>
                                                    <!--========== SALES DATE ==========-->
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td class="text-right"><label
                                                                class="col-sm-3 col-form-label">Invoice Date</label>
                                                        </td>
                                                        <td align="center">
                                                            <input type="date" id="Invoice_Date"
                                                                value="<?php echo date('Y-m-d'); ?>" name="Invoice_Date"
                                                                class="form-control form-control-sm"
                                                                onchange="FetchSubTotal(this.value)" />
                                                        </td>
                                                    </tr>
                                                    <!--========== SUB TOTAL 1 ==========-->
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td class="text-right"><label
                                                                class="col-sm-3 col-form-label">Sub
                                                                Total 1</label></td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="number" id="Sub_Total"
                                                                    placeholder="Enter Daily Stock Sales Eg:- RM 1.20"
                                                                    step="0.01" class="form-control form-control-sm"
                                                                    name="Total" />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!--========== REJECT BURGER / SAUSAGE BUNS ==========-->
                                                    <tr>
                                                        <td><label class="col-sm-3 col-form-label">Burger / Sausage
                                                                Buns</label>
                                                        </td>
                                                        <td><label class="col-sm-3 col-form-label">RM 1.70 / 1
                                                                pieces</label></td>
                                                        <td align="center">
                                                            <div class="col-sm-9">
                                                                <input type="number" id="qty1"
                                                                    placeholder="Insert Reject Quantity Eg:- 5"
                                                                    class="form-control form-control-sm" />
                                                            </div>
                                                        </td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="number" id="Sub_Total1" placeholder=""
                                                                    class="form-control form-control-sm" disabled />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!--========== REJECT OBLONG BUNS ==========-->
                                                    <tr>
                                                        <td><label class="col-sm-3 col-form-label">Oblong Buns</label>
                                                        </td>
                                                        <td><label class="col-sm-3 col-form-label">RM 2.70 / 1
                                                                pieces</label></td>
                                                        <td align="center">
                                                            <div class="col-sm-9">
                                                                <input type="number" id="qty2"
                                                                    placeholder="Insert Reject Quantity Eg:- 5"
                                                                    class="form-control form-control-sm" />
                                                            </div>
                                                        </td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="number" id="Sub_Total2" placeholder=""
                                                                    class="form-control form-control-sm" disabled />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!--========== REJECT CHICKEN / BEEF / SAUSAGE ==========-->
                                                    <tr>
                                                        <td><label class="col-sm-3 col-form-label">Chicken / Beef /
                                                                Sausage</label>
                                                        </td>
                                                        <td><label class="col-sm-3 col-form-label">RM 1.80 / 1
                                                                pieces</label></td>
                                                        <td align="center">
                                                            <div class="col-sm-9">
                                                                <input type="number" id="qty3"
                                                                    placeholder="Insert Reject Quantity Eg:- 5"
                                                                    class="form-control form-control-sm" />
                                                            </div>
                                                        </td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="number" id="Sub_Total3" placeholder=""
                                                                    class="form-control form-control-sm" disabled />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!--========== REJECT BEEF / CHICKEN OBLONG ==========-->
                                                    <tr>
                                                        <td><label class="col-sm-3 col-form-label">Lamb / Beef / Chicken
                                                                Oblong</label></td>
                                                        <td><label class="col-sm-3 col-form-label">RM 3.60 / 1
                                                                pieces</label></td>
                                                        <td align="center">
                                                            <div class="col-sm-9">
                                                                <input type="number" id="qty4"
                                                                    placeholder="Insert Reject Quantity Eg:- 5"
                                                                    class="form-control form-control-sm" />
                                                            </div>
                                                        </td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="number" id="Sub_Total4" placeholder=""
                                                                    class="form-control form-control-sm" disabled />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!--========== REJECT CRSIPY ==========-->
                                                    <tr>
                                                        <td><label class="col-sm-3 col-form-label">Crispy</label></td>
                                                        <td><label class="col-sm-3 col-form-label">RM 2.60 / 1
                                                                pieces</label></td>
                                                        <td align="center">
                                                            <div class="col-sm-9">
                                                                <input type="number" id="qty5"
                                                                    placeholder="Insert Reject Quantity Eg:- 5"
                                                                    class="form-control form-control-sm" />
                                                            </div>
                                                        </td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="number" id="Sub_Total5" placeholder=""
                                                                    class="form-control form-control-sm" disabled />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!--========== REJECT EGG ==========-->
                                                    <tr>
                                                        <td><label class="col-sm-3 col-form-label">Egg</label></td>
                                                        <td><label class="col-sm-3 col-form-label">RM 1.20 / 1
                                                                pieces</label></td>
                                                        <td align="center">
                                                            <div class="col-sm-9">
                                                                <input type="number" id="qty6"
                                                                    placeholder="Insert Reject Quantity Eg:- 5"
                                                                    class="form-control form-control-sm" />
                                                            </div>
                                                        </td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="number" id="Sub_Total6" placeholder=""
                                                                    class="form-control form-control-sm" disabled />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!--========== REJECT CHEESE ==========-->
                                                    <tr>
                                                        <td><label class="col-sm-3 col-form-label">Cheese</label>
                                                        </td>
                                                        <td><label class="col-sm-3 col-form-label">RM 1.40 / 1
                                                                pieces</label></td>
                                                        <td align="center">
                                                            <div class="col-sm-9">
                                                                <input type="number" id="qty7"
                                                                    placeholder="Insert Reject Quantity Eg:- 5"
                                                                    class="form-control form-control-sm" />
                                                            </div>
                                                        </td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="number" id="Sub_Total7" placeholder=""
                                                                    class="form-control form-control-sm" disabled />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!--========== STAFF FOOD ==========-->
                                                    <tr>
                                                        <td><label class="col-sm-3 col-form-label">Staff Food</label>
                                                        </td>
                                                        <td><label class="col-sm-3 col-form-label">RM 5.00 /
                                                                Staff</label>
                                                        </td>
                                                        <td align="center">
                                                            <div class="col-sm-9">
                                                                <input type="number" id="stafffood"
                                                                    placeholder="Enter Staff Food Eg:- RM 1.20"
                                                                    step="0.01" class="form-control form-control-sm" />
                                                            </div>
                                                        </td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="text" id="Sub_Total8" step="0.01"
                                                                    placeholder="" class="form-control form-control-sm"
                                                                    disabled />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!--========== TOTAL 2 ==========-->
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td align="right"><label class="col-sm-3 col-form-label">Sub
                                                                Total
                                                                2</label></td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="text" id="Total_2" placeholder=""
                                                                    class="form-control form-control-sm" disabled />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!--========== TOTAL 3 ==========-->
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td align="right"><label
                                                                class="col-sm-3 col-form-label">Total</label></td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="text" id="Total_3" placeholder=""
                                                                    class="form-control form-control-sm" disabled />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!--========== FOOD PANDA ==========-->
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td align="right"><label class="col-sm-3 col-form-label">Food
                                                                Panda
                                                                (+)</label></td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="number" id="FoodPanda" step="0.01"
                                                                    placeholder="Enter Food Panda Eg:- RM 1.20"
                                                                    class="form-control form-control-sm" />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!--========== ONLINE BANKING ==========-->
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td align="right"><label class="col-sm-3 col-form-label">Online
                                                                Banking (+)</label></td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="number" id="OnlineBanking" step="0.01"
                                                                    placeholder="Enter Online Banking Eg:- RM 1.20"
                                                                    class="form-control form-control-sm" />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!--========== Overhead ==========-->
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td align="right"><label
                                                                class="col-sm-3 col-form-label">Overhead
                                                                (+)</label></td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="number" id="Overhead" step="0.01"
                                                                    placeholder="Enter Overhead Eg:- RM 1.20"
                                                                    class="form-control form-control-sm"
                                                                    name="Overhead" />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!--========== CASH IN HAND ==========-->
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td align="right"><label class="col-sm-3 col-form-label">Cash in
                                                                Hand (+)</label></td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="number" id="CashInHand" step="0.01"
                                                                    placeholder="Enter Cash in Hand Eg:- RM 1.20"
                                                                    class="form-control form-control-sm"
                                                                    name="Total_Cash" />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!--========== TOTAL SALES ==========-->
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td align="right"><label class="col-sm-3 col-form-label">Total
                                                                Sales</label></td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="number" id="TotalSales"
                                                                    placeholder="Enter Total Sales Eg:- RM 1.20"
                                                                    step="0.01" class="form-control form-control-sm"
                                                                    name="Total_Sales" />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!--========== PROFIT / SHOT +/- ==========-->
                                                    <tr>
                                                        <td align="right">Invoice Message</td>
                                                        <td align="center">
                                                            <input type="textarea" id="Invoice_Message"
                                                                placeholder="Enter a message for any inconvenience"
                                                                name="Invoice_Message"
                                                                class="form-control form-control-sm" />
                                                        </td>
                                                        <td align="right"><label class="col-sm-3 col-form-label">Profit
                                                                / Shot (+/-)</label></td>
                                                        <td align="center">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">RM</span>
                                                                </div>
                                                                <input type="text" id="GrandTotal" placeholder=""
                                                                    class="form-control form-control-sm" disabled />
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        <button class="btn btn-light">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class='col-lg-12 grid-margin stretch-card'>
                <div class='card'>
                    <div class='card-body'>
                        <h4 class='card-title'>Daily Invoice Calculation</h4>
                        <p class='card-description'>
                            Total Daily Invoice of each Daily Sales
                        </p>
                        <p class='card-description'>
                        <p>There are currently <?php echo" <b> $invoice_num </b>";?>Total Daily Sales</p>
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
                                                    <th class="text-center">#</th>
                                                    <th>Total (RM)</th>
                                                    <th>Overhead (RM)</th>
                                                    <th>Total Cash (RM)</th>
                                                    <th>Total Sales (RM)</th>
                                                    <th>Invoice Message</th>
                                                    <th class="text-center">Invoice Date</th>
                                                    <th></th>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3"></th>
                                                        <th style="text-align:center">TOTAL:</th>
                                                        <th colspan="4"></th>
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


        <!-- SCRIPT FOR FETCH RECORD INVOICE -->
        <script type="text/javascript">
        load_data(); // first load
        function load_data(initial_date, final_date) {
            var ajax_url = "../Database/Sales/Invoice_Calculation/fetch_invoice.php";

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
                        "action": "fetch_invoice",
                        "initial_date": initial_date,
                        "final_date": final_date
                    },
                    "dataSrc": "records"
                },
                "columns": [{
                        "data": "Invoice_Id"
                    },
                    {
                        "data": "Total"
                    },
                    {
                        "data": "Overhead"
                    },
                    {
                        "data": "Total_Cash"
                    },
                    {
                        "data": "Total_Sales"
                    },
                    {
                        "data": "Invoice_Message"
                    },
                    {
                        "data": "Invoice_Date"
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
                        .column(4)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Total over this page
                    pageTotal = api
                        .column(4, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(4).footer()).html(
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
            var Invoice_Date = $('#InvoiceDateField').val();
            var Invoice_Message = $('#InvoiceMessageField').val();
            var Total_Sales = $('#TotalSalesField').val();
            var Total_Cash = $('#TotalCashField').val();
            var Overhead = $('#OverheadField').val();
            var Total = $('#TotalField').val();
            var trid = $('#trid').val();
            var id = $('#id').val();
            if (Total != '' && Overhead != '' && Total_Cash != '' && Total_Sales != '' &&
                Invoice_Message != '' && Invoice_Date != '') {
                $.ajax({
                    url: "../Database/Sales/Invoice_Calculation/update_invoice.php",
                    type: "post",
                    data: {
                        Invoice_Date: Invoice_Date,
                        Invoice_Message: Invoice_Message,
                        Total_Sales: Total_Sales,
                        Total_Cash: Total_Cash,
                        Overhead: Overhead,
                        Total: Total,
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
                            row.row("[id='" + trid + "']").data([id, Total,
                                Overhead, Total_Cash, Total_Sales,
                                Invoice_Message, Invoice_Date,
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
                url: "../Database/Sales/Invoice_Calculation/single_data_invoice.php",
                data: {
                    id: id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#InvoiceDateField').val(json.Invoice_Date);
                    $('#InvoiceMessageField').val(json.Invoice_Message);
                    $('#TotalSalesField').val(json.Total_Sales);
                    $('#TotalCashField').val(json.Total_Cash);
                    $('#OverheadField').val(json.Overhead);
                    $('#TotalField').val(json.Total);
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
                    url: "../Database/Sales/Invoice_Calculation/delete_invoice.php",
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

        // SCRIPT FOR FETCH SUBTOTAL
        function FetchSubTotal(date) {
            // alert(date);   
            $.ajax({
                type: 'post',
                url: '../Database/Sales/Invoice_Calculation/fetch_subtotal.php',
                dataType: "json",
                data: {
                    date: date
                },
                success: function(data) {
                    if (data.success) {
                        $('#Sub_Total').val(data.total);
                        // Sub_Total
                    }
                }

            })
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
                        <h5 class="modal-title" id="exampleModalLabel">Update Invoice</h5>
                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon"
                            data-bs-dismiss="modal" aria-label="Close"><i class="ti-home"></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateUser">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="trid" id="trid" value="">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Invoice Date</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="InvoiceDateField" name="Invoice_Date"
                                        disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Total</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="TotalField" name="Total"
                                            placeholder="Enter Total Eg:-RM1.20" step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Overhead</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="OverheadField" name="Overhead"
                                            placeholder="Enter Overhead Eg:-RM1.20" step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Total Cash</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="TotalCashField" name="Total_Cash"
                                            placeholder="Enter Total Cash Eg:-RM1.20" step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Total Sales</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">RM</span>
                                        </div>
                                        <input type="number" class="form-control" id="TotalSalesField"
                                            placeholder="Enter Total Sales Eg:-RM1.20" name="Total_Sales" step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Message</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="InvoiceMessageField"
                                        placeholder="Best Sales Today" name="Invoice_Message">
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