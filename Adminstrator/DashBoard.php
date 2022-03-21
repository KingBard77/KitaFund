<!--========== DASHBOARD ==========-->
<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php 
// This function outputs theoretical HTML
// for adding ads to a Web page.

$page_title = 'Dashboard';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';
?>

<?php
// Define the Number of Employee query:
$query = "SELECT p.Profile_Id, e.Employee_Code, p.Image_Name, p.First_Name, p.Last_Name, 
p.Email, p.Phone, p.Joining_Date
FROM employee e, profile p
WHERE e.Profile_Id = p.Profile_Id
ORDER BY p.Profile_Id ASC";
$employee = @mysqli_query($dbc, $query);

// Count the number of returned rows:
$employee_num = mysqli_num_rows($employee);
?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome <?php echo" Mr. {$_SESSION["Username"]} "?></h3>
                        <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span
                                class="text-primary">3 unread alerts!</span></h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                    id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> Today <?php echo  "( ".date("d M, Y")." )" ?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card" style="width: 18rem;">
                    <img src="../Images/dashboard/Menu.png" class="rounded" alt="people">
                </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <?php
                                // Define the Number of Category query:
                                $query = "SELECT * FROM category
                                ORDER BY Category_Id ASC";
                                $category = mysqli_query($dbc, $query);
                                
                                // Count the number of returned rows:
                                $category_num = mysqli_num_rows($category);
                                
                                ?>
                                <p class="mb-4">Total Category</p>
                                <p class="fs-30 mb-2"><?php echo "$category_num" ?></p>
                                <p>10.00% (30 days)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <?php
                                // Define the Number of Invoice query:
                                $sql = "SELECT  SUM(Total_Sales) from invoice";
                                $invoice = $dbc->query($sql);
                                //display data on web page
                                ?>
                                <p class="mb-4">Total Sales</p>
                                <p class="fs-30 mb-2">
                                    <?php 
                                    while($row = mysqli_fetch_array($invoice)){
                                        echo "RM ". $row['SUM(Total_Sales)']; 
                                    }?>
                                </p>
                                <p>22.00% (30 days)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <?php
                                // Define the Number of Employee query:
                                $query = "SELECT *
                                FROM employee e, profile p
                                WHERE e.Profile_Id = p.Profile_Id
                                ORDER BY p.Profile_Id ASC";
                                $employee = @mysqli_query($dbc, $query);

                                // Count the number of returned rows:
                                $employee_num = mysqli_num_rows($employee);
                                ?>
                                <p class="mb-4">Number of Employee</p>
                                <p class="fs-30 mb-2"><?php echo "$employee_num" ?></p>
                                <p>2.00% (30 days)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <?php
                                // Define the Number of Income query:
                                $sql = "SELECT  SUM(Net_Income) FROM income";
                                $income = $dbc->query($sql);
                                //display data on web page
                                ?>
                                <p class="mb-4">Total Income</p>
                                <p class="fs-30 mb-2">
                                    <?php 
                                    while($row = mysqli_fetch_array($income)){
                                    echo "RM ". $row['SUM(Net_Income)']; 
                                    }?>
                                </p>
                                <p>22.00% (30 days)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 2 -->
        <div class="row">
            <!-- Dotted Lined Graph Summary Report -->
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">BurgerByte Details</p>
                        <p class="font-weight-500">The total number of sessions within the date range. It is the period
                            time a user is actively engaged with your website, page or app, etc</p>
                        <div class="d-flex flex-wrap mb-5">
                            <div class="mr-5 mt-3">
                                <p class="text-muted">Stock value</p>
                                <?php
                                // Define the query:
                                $query = "SELECT * 
                                FROM category
                                ORDER BY Category_Id ASC";
                                $stock = @mysqli_query($dbc, $query);
                                // Count the number of returned rows:
                                $stock_num = mysqli_num_rows($stock);
                                ?>
                                <h3 class="text-primary fs-30 font-weight-medium"><?php echo $stock_num ?></h3>
                            </div>
                            <div class="mr-5 mt-3">
                                <p class="text-muted">Sales</p>
                                <?php
                                // Define the query:
                                $sql = "SELECT  SUM(SubTotal) from sales";
                                $sales = $dbc->query($sql);
                                //display data on web page
                                ?>
                                <h3 class="text-primary fs-30 font-weight-medium">
                                    <?php 
                                    while($row = mysqli_fetch_array($sales)){
                                        echo "RM ". $row['SUM(SubTotal)']; 
                                    }?>
                                </h3>
                            </div>
                            <div class="mr-5 mt-3">
                                <p class="text-muted">Invoice</p>
                                <?php
                                // Define the query:
                                $sql = "SELECT  SUM(Total_Sales) from invoice";
                                $invoice = $dbc->query($sql);
                                //display data on web page
                                ?>
                                <h3 class="text-primary fs-30 font-weight-medium">
                                    <?php 
                                    while($row = mysqli_fetch_array($invoice)){
                                        echo "RM ". $row['SUM(Total_Sales)']; 
                                    }?>
                                </h3>
                            </div>
                            <div class="mt-3">
                                <p class="text-muted">Income</p>
                                <?php
                                // Define the query:
                                $sql = "SELECT  SUM(Net_Income) from income";
                                $income = $dbc->query($sql);
                                //display data on web page
                                ?>
                                <h3 class="text-primary fs-30 font-weight-medium">
                                    <?php 
                                    while($row = mysqli_fetch_array($income)){
                                        echo "RM ". $row['SUM(Net_Income)']; 
                                    }?>
                                </h3>
                            </div>
                        </div>
                        <canvas id="order-chart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Bar Graph Sales Report -->
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Sales Report</p>
                            <a href="#" class="text-info">View all</a>
                        </div>
                        <p class="font-weight-500">The is bar-graph total sales for BurgerByte Company every month.
                            It is the period time in a year to show total sales for every month in BurgerByte Company,
                            page or app, etc.
                        </p>
                        <br />
                        <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>

                        <canvas id="graphCanvas"></canvas>
                        <script>
                        $(document).ready(function() {
                            showGraph();
                        });

                        function showGraph() {
                            {
                                $.post("../Database/Chart/Sales.php",
                                    function(data) {
                                        console.log(data);
                                        var date = [];
                                        var sales = [];
                                        var barColors = [
                                            "rgba(75,73,172, 1.0)",
                                            "rgba(75,73,172, 0.8)",
                                            "rgba(75,73,172, 0.6)",
                                            "rgba(75,73,172, 0.4)",
                                            "rgba(75,73,172, 0.2)"
                                        ];


                                        for (var i in data) {
                                            date.push(data[i].month);
                                            sales.push(data[i].sales);
                                        }

                                        var chartdata = {
                                            labels: date,
                                            datasets: [{
                                                label: 'Total Sales',
                                                backgroundColor: barColors,
                                                borderColor: '#4B49AC',
                                                hoverBackgroundColor: '#CCCCCC',
                                                hoverBorderColor: '#666666',
                                                data: sales,
                                                x : 100
                                            }]
                                        };

                                        var graphTarget = $("#graphCanvas");

                                        var barGraph = new Chart(graphTarget, {
                                            type: 'bar',
                                            data: chartdata
                                        });
                                    });
                            }
                        }
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 3 -->
        <div class="row">
            <!-- Pie Chart Graph Sales Month Report -->
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card position-relative">
                    <div class="card-body">
                        <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2"
                            data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                            <div class="ml-xl-4 mt-3">
                                                <p class="card-title">Detailed Reports</p>
                                                <?php
                                                // Define the Number of Invoice query:
                                                $sql = "SELECT  SUM(Total_Sales) from invoice";
                                                $invoice = $dbc->query($sql);
                                                //display data on web page
                                                ?>
                                                <h1 class="text-primary">
                                                    <?php 
                                                    while($row = mysqli_fetch_array($invoice)){
                                                        echo "RM ". $row['SUM(Total_Sales)']; 
                                                    }?>
                                                </h1>
                                                <h3 class="font-weight-500 mb-xl-4 text-primary">Total Sales</h3>
                                                <p class="mb-2 mb-xl-0">The is total sales for every month in this year
                                                    based on 9 stock.
                                                    This part lists the detailed sum sales for all stock in every month
                                                    into a pie chart.
                                                    <b class="text-success"><i class='ti-arrow-up'></i> Positve</b> or
                                                    <b class="text-danger"><i class='ti-arrow-down'></i> Negative</b>
                                                    Sales is happen when Total Sales is not balance or equal
                                                    with SubTotal for all stock.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xl-9">
                                            <div class="row">
                                                <!-- Detail Invoices Report -->
                                                <div class="col-md-6 border-right">
                                                    <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                        <table class="table table-borderless report-table">
                                                            <th>Month</th>
                                                            <th>Total Shot</th>
                                                            <th>Sales</th>
                                                            <th>Total Sales</th>
                                                            <?php
                                                            // Define the query:
                                                            $sql = "SELECT 
                                                            (Total - Total_Sales) AS Total_Shot,
                                                            MONTHNAME(Invoice_Date) AS month, 
                                                            SUM(Total_Sales) AS Total_Sales
                                                            FROM     invoice
                                                            GROUP BY MONTHNAME(Invoice_Date)";
                                                            $sales_month = mysqli_query($dbc,$sql);

                                                            // Count the number of returned rows:
                                                            $employee_num = mysqli_num_rows($sales_month);
                                                            if(mysqli_num_rows($sales_month) > 0)  
                                                            {  
                                                                while($row = mysqli_fetch_array($sales_month))  
                                                                {  
                                                            ?>
                                                            <tr>
                                                                <td class="text-muted"><?php echo $row["month"]; ?></td>

                                                                <td class="text-muted">
                                                                    RM
                                                                    <?php echo number_format($row["Total_Shot"],2); ?>

                                                                    <?php
                                                                    $number = $row['Total_Shot']; // enter any number of your choice here
                                                                    if ($number > 0) // condition for positive numbers
                                                                    {
                                                                        echo  " <td class='text-success'><i class='ti-arrow-up'></i> Positive Sales</td>";
                                                                    } else if ($number < 0) // condition for negative number
                                                                    {
                                                                        echo " <td class='text-danger'><i class='ti-arrow-down'></i> Negative Sales</td>";
                                                                    } else
                                                                    {
                                                                        echo " <td class='text-warning'>Balance Sales</td>";
                                                                    } 
                                                                ?>
                                                                </td>
                                                                <td>
                                                                    <h5 class="font-weight-bold mb-0">
                                                                        RM <?php echo $row["Total_Sales"]; ?>
                                                                    </h5>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </table>
                                                    </div>
                                                </div>

                                                <!-- Pie Chart Graph Sales Month Report -->
                                                <div class="col-md-6 mt-3">
                                                    <div id="piechartCanvas" style="width: 700px; height: 500px;"></div>
                                                    <script type="text/javascript"
                                                        src="https://www.gstatic.com/charts/loader.js"></script>
                                                    <script type="text/javascript"
                                                        src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                    <script type="text/javascript">
                                                    google.charts.load('current', {
                                                        'packages': ['corechart']
                                                    });

                                                    google.charts.setOnLoadCallback(drawChart);

                                                    function drawChart() {

                                                        var chartData = $.ajax({
                                                            url: "../Database/Chart/Invoice.php",
                                                            dataType: "json",
                                                            async: false
                                                        }).responseText;

                                                        var data = google.visualization.arrayToDataTable(JSON.parse(
                                                            chartData));

                                                        var options = {
                                                            title: 'Total Invoices for Every Sales in each Month'
                                                        };

                                                        var chart = new google.visualization.PieChart(document
                                                            .getElementById('piechartCanvas'));

                                                        chart.draw(data, options);
                                                    }
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                            <div class="ml-xl-4 mt-3">
                                                <p class="card-title">Detailed Products</p>
                                                <h1 class="text-primary">$34040</h1>
                                                <h3 class="font-weight-500 mb-xl-4 text-primary">North America</h3>
                                                <p class="mb-2 mb-xl-0">The total number of sessions within the date
                                                    range. It is the period time a user is actively engaged with your
                                                    website, page or app, etc</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xl-9">
                                            <div class="row">
                                                <div class="col-md-6 border-right">
                                                    <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                        <table class="table table-borderless report-table">
                                                            <tr>
                                                                <td class="text-muted">Illinois</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4">
                                                                        <div class="progress-bar bg-primary"
                                                                            role="progressbar" style="width: 70%"
                                                                            aria-valuenow="70" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h5 class="font-weight-bold mb-0">713</h5>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">Washington</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4">
                                                                        <div class="progress-bar bg-warning"
                                                                            role="progressbar" style="width: 30%"
                                                                            aria-valuenow="30" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h5 class="font-weight-bold mb-0">583</h5>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">Mississippi</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4">
                                                                        <div class="progress-bar bg-danger"
                                                                            role="progressbar" style="width: 95%"
                                                                            aria-valuenow="95" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h5 class="font-weight-bold mb-0">924</h5>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">California</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4">
                                                                        <div class="progress-bar bg-info"
                                                                            role="progressbar" style="width: 60%"
                                                                            aria-valuenow="60" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h5 class="font-weight-bold mb-0">664</h5>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">Maryland</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4">
                                                                        <div class="progress-bar bg-primary"
                                                                            role="progressbar" style="width: 40%"
                                                                            aria-valuenow="40" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h5 class="font-weight-bold mb-0">560</h5>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">Alaska</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4">
                                                                        <div class="progress-bar bg-danger"
                                                                            role="progressbar" style="width: 75%"
                                                                            aria-valuenow="75" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h5 class="font-weight-bold mb-0">793</h5>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <canvas id="south-america-chart"></canvas>
                                                    <div id="south-america-legend"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 4 -->
        <div class="row">
            <!-- Stock Purchase Table -->
            <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Purcahse Stock</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>Owner Code</th>
                                        <th class="text-center">Purchase Date</th>
                                        <th class="text-center">Purchase Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                // Define the query:
                                $query = "SELECT *
                                FROM purchase
                                INNER JOIN profile  
                                ON profile.Profile_Id = purchase.Owner_Code  
                                iNNER JOIN owner
                                ON owner.Profile_Id = purchase.Owner_Code 
                                ORDER BY  Purchase_Id ASC";
                                $purchase = mysqli_query($dbc, $query);

                                // Count the number of returned rows:
                                $purchase_num = mysqli_num_rows($purchase);
                                if(mysqli_num_rows($purchase) > 0)  
                                {  
                                    while($row = mysqli_fetch_array($purchase))  
                                    { 
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row["Owner_Code"]; ?></td>

                                        <?php $time = strtotime($row["Purchase_Date"]);?>
                                        <td>
                                            <div class="col text-center">
                                                <?php echo date(' d F, Y', $time) ?>
                                            </div>
                                        </td>

                                        <td class="font-weight-medium">
                                            <?php
                                            $Status = '';
                                            if($row["Purchase_Status"] == 'Pending'){
                                                $Status ='<label class="badge badge-warning">Pending</label>';
                                            }
                                            if($row["Purchase_Status"] == 'Purchase'){
                                                $Status ='<label class="badge badge-success">Purchase</label>';
                                            }
                                            ?>
                                            <div class="text-center"><?php echo $Status ?></div>
                                        </td>
                                        <td>
                                            <div class="col text-center">
                                                <a href="javascript:void();" data-id="'.$row['Purchase_Id'].'"
                                                    class="btn btn-outline-info btn-sm editbtn">View</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php  
                                    }  
                                }  
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- To-Do-List -->
            <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">To Do Lists</h4>
                        <div class="list-wrapper pt-2">
                            <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                <li>
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Meeting with Urban Team
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked>
                                            Duplicate a project for new customer
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li>
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Project meeting with CEO
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked>
                                            Follow up of team zilla
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li>
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Level up for Antony
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="add-items d-flex mb-0 mt-2">
                            <input type="text" class="form-control todo-list-input" placeholder="Add new task">
                            <button class="add btn btn-icon text-primary todo-list-add-btn bg-transparent"><i
                                    class="icon-circle-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 5 -->
        <div class="row">
            <!-- Category Table -->
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Category</p>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th class="pl-0  pb-2 border-bottom">Stock Name</th>
                                        <th class="border-bottom pb-2 text-center">Categories</th>
                                        <th class="border-bottom pb-2 text-center">Stock In</th>
                                    </tr>
                                </thead>
                                <?php
                                // Define the query:
                                $query = "Select *
                                FROM stock s JOIN category c ON s.Category_id = c.Category_id 
                                ORDER BY Stock_Id ASC";
                                $category = mysqli_query($dbc, $query);

                                // Count the number of returned rows:
                                $category_num = mysqli_num_rows($category);
                                if(mysqli_num_rows($category) > 0)  
                                {  
                                    while($row = mysqli_fetch_array($category))  
                                    {  
                                ?>
                                <tbody>
                                    <tr>
                                        <td class="pl-0"><?php echo $row["Stock_Name"]; ?></td>
                                        <td>
                                            <p class="mb-0">
                                            <div class="col text-center"><span class="font-weight-bold mr-2">
                                                    <?php echo $row["Category_Name"]; ?></span>
                                            </div>
                                            </p>
                                        </td>
                                        <td class="text-muted">
                                            <div class="col text-center">
                                                <?php echo $row["Quantity_In"]; ?>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php  
                                    }  
                                }  
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stock Purchase Table -->
            <div class="col-md-4 stretch-card grid-margin">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Charts</p>
                                <div class="charts-data">
                                    <div class="mt-3">
                                        <p class="mb-0">Data 1</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-inf0" role="progressbar" style="width: 95%"
                                                    aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mb-0">5k</p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="mb-0">Data 2</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 35%"
                                                    aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mb-0">1k</p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="mb-0">Data 3</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 48%"
                                                    aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mb-0">992</p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="mb-0">Data 4</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 25%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mb-0">687</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 stretch-card grid-margin grid-margin-md-0">
                        <div class="card data-icon-card-primary">
                            <div class="card-body">
                                <p class="card-title text-white">Number of Meetings</p>
                                <div class="row">
                                    <div class="col-8 text-white">
                                        <h3>34040</h3>
                                        <p class="text-white font-weight-500 mb-0">The total number of sessions within
                                            the date range.It is calculated as the sum . </p>
                                    </div>
                                    <div class="col-4 background-icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Employee Table -->
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">My Employee</p>
                        <?php
                        // Define the query:
                        $query = "SELECT p.Profile_Id, e.Employee_Code, p.Image_Name, p.First_Name, p.Last_Name, 
                        p.Email, p.Phone, p.Joining_Date
                        FROM employee e, profile p
                        WHERE e.Profile_Id = p.Profile_Id
                        ORDER BY p.Profile_Id ASC";
                        $employee = @mysqli_query($dbc, $query);

                        // Count the number of returned rows:
                        $employee_num = mysqli_num_rows($employee);
                        if(mysqli_num_rows($employee) > 0)  
                        {  
                            while($row = mysqli_fetch_array($employee))  
                            {  
                        ?>
                        <ul class="icon-data-list">
                            <li>
                                <div class="d-flex">
                                    <img src="../Images/Employee_Image/<?php echo $row["Image_Name"]; ?>" alt="user">
                                    <div>
                                        <p class="text-info mb-1"><?php echo $row["First_Name"]; ?></p>
                                        <p class="mb-0"><?php echo $row["Employee_Code"]; ?></p>
                                        <small><?php echo $row["Phone"]; ?></small> |
                                        <small><?php echo $row["Email"]; ?></small>
                                    </div>
                                </div>
                            </li>
                            <?php  
                            }  
                        }  
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Plugin js for this page -->
        <script src="../vendors/chart.js/Chart.min.js"></script>
        <script src="../vendors/datatables.net/jquery.dataTables.js"></script>
        <script src="../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
        <script src="../js/dataTables.select.min.js"></script>
        <!-- End plugin js for this page -->
        <!-- Custom js for this page-->
        <script src="../js/dashboard.js"></script>
        <script src="../js/Chart.roundedBarCharts.js"></script>
        <!-- End custom js for this page-->

        <script type="text/javascript" src="../js/Chart.min.js"></script>
        <script type="text/javascript" src="../js/Chart.min.js"></script>
        <!--========== INCLUDE FOOTER ==========-->
        <?php include('../partials/Footer.html'); ?>