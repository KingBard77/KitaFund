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
                        <h6 class="font-weight-normal mb-0">You're in <b>BurgerByte System!</b> You have <span
                                class="text-primary">3 unread alerts!</span></h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                    id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> Today <?php echo  "( ".date("d F, Y")." )" ?>
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

        <!-- SECTION 1 -->
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card mb-3" style="width: 18rem;">
                    <img src="../Images/dashboard/Menu.png" class="rounded" alt="people">
                </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-12 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card mb-3">
                            <div class="card-body">
                                <?php
                                // Define the Weather Forecasting:
                                $cache_file = 'data.json';
                                if(file_exists($cache_file)){
                                $data = json_decode(file_get_contents($cache_file));
                                }else{
                                $api_url = 'https://content.api.nytimes.com/svc/weather/v2/current-and-seven-day-forecast.json';
                                $data = file_get_contents($api_url);
                                file_put_contents($cache_file, $data);
                                $data = json_decode($data);
                                }

                                $current = $data->results->current[0];
                                $forecast = $data->results->seven_day_forecast;

                                function convert2cen($value,$unit){
                                    if($unit=='C'){
                                    return $value;
                                    }else if($unit=='F'){
                                    $cen = ($value - 32) / 1.8;
                                        return round($cen,2);
                                    }
                                }
                                ?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-8">
                                            <h5 class="font-weight-bold">
                                                <?php echo $current->city.' (Perak / '.$current->country.')';?>
                                            </h5><br />
                                            <p class="fs-30 mb-2" style="font-weight-bold">
                                                <img style="margin-left:-10px;" src="<?php echo $current->image;?>">
                                                <?php echo $current->description;?>
                                            </p>
                                        </div>
                                        <div class="col-4">
                                            <h1 class="font-weight-bold text-right">
                                                <?php echo convert2cen($current->temp,$current->temp_unit);?> °C</h1>
                                            <br />
                                            <h6 class="text-muted text-right"><?php 
                                                date_default_timezone_set("Asia/Kuala_Lumpur");
                                                echo date("l | H:i A");?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-4">
                                        <h5 class="font-weight-bold">Wind Speed</h5>
                                        <h6 class="text-muted">
                                            <?php echo $current->windspeed;?>
                                            <?php echo $current->windspeed_unit;?></h6>
                                    </div>
                                    <div class="col-4">
                                        <h5 class="font-weight-bold">Pressue</h5>
                                        <h6 class="text-muted">
                                            <?php echo $current->pressure;?>
                                            <?php echo $current->pressure_unit;?></h6>
                                    </div>
                                    <div class="col-4">
                                        <h5 class="font-weight-bold">Visibility</h5>
                                        <h6 class="text-muted">
                                            <?php echo $current->visibility;?>
                                            <?php echo $current->visibility_unit;?></h6>
                                    </div>
                                </div>
                                &nbsp;
                                <?php
                                if ($current->description == "Partly sunny"){
                                    $Works ='<span>Prepare come <b class="text-success"><i class="ti-alarm-clock"></i> 4.30 PM early</b> than <b>5.00 PM</b> usual into a business.</span></p>';
                                    $Prediction ='<span>Prepare a <b class="text-success"><i class="ti-arrow-up"></i> 40%</b> Stock-In into a business.</span></p>';
                                }
                                if ($current->description == "Partly cloudy"){
                                    $Works ='<span>Prepare a <b class="text-info"><i class="ti-alarm-clock"></i> 4.45 PM early</b> than <b>5.00 PM</b> usual into a business.</span></p>';
                                    $Prediction ='<span>Prepare a <b class="text-info"><i class="ti-arrow-up"></i> 25%</b> Stock-In into a business.</span></p>';
                                }
                                if ($current->description == "Cloudy in the morning with a shower in spots followed by sun and areas of high clouds"){
                                    $Works ='<span>Prepare a <b class="text-warning"><i class="ti-alarm-clock"></i> 5.15 PM late</b> than <b>5.00 PM</b> usual into a business.</span></p>';
                                    $Prediction ='<span>Prepare a <b class="text-warning"><i class="ti-arrow-up"></i> 10%</b> Stock-In into a business.</span></p>';
                                }
                                if ($current->description == "Mostly cloudy with a thunderstorm in a couple of spots"){
                                    $Works ='<span>Prepare a <b class="text-danger"><i class="ti-alarm-clock"></i> 5.30 PM late</b> than <b>5.00 PM</b> usual into a business.</span></p>';
                                    $Prediction ='<span>Prepare a <b class="text-danger"><i class="ti-arrow-down"></i> -10%</b> Stock-In into a business.</span></p>';
                                }
                                if ($current->description == "Clouds giving way to some sun"){
                                    $Works ='<span>Prepare a <b class="text-secondary"><i class="ti-alarm-clock"></i> 6.00 PM late</b> than <b>5.00 PM</b> usual into a business.</span></p>';
                                    $Prediction ='<span>Prepare a <b class="text-secondary"><i class="ti-arrow-down"></i> -20%</b> Stock-In into a business.</span></p>';
                                }
                                echo "<p><span class='text-primary font-weight-bold'><i class='ti-help-alt'></i> Prediction : </span>".$Prediction;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

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

        <!-- SECTION WEATHER FORECASTING -->
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Weather Forecast for Every Days</p>
                        <p class="font-weight-500">This is a <b class="text-info">Weather Forecast</b> of the <b>Current
                                Location</b>
                            for BurgerByte
                            Enterprise.
                            It is the period time in a week to <br>
                            show prediction of <b>Weather</b> every day in BurgerByte
                            Enterprise, page or app, etc.</p>
                        <br />
                        <div class="border-top pt-3 text-center">
                            <div class="container">
                                <div class="row">
                                    <?php $loop=0; foreach($forecast as $f){ $loop++;?>
                                    <div class="col">
                                        <h6 class="font-weight-bold">
                                            <?php echo $f->day;?></h6>
                                        <img src="<?php echo $f->image;?>">
                                        <br />&nbsp;<br />
                                        <h7 class="font-weight-bold">
                                            <?php echo convert2cen($f->low,$f->low_unit);?><h7 class="font-weight-bold">
                                                °C -</h7>
                                            <?php echo convert2cen($f->high,$f->high_unit);?><h7
                                                class="font-weight-bold"> °C</h7>
                                        </h7>
                                        <hr style="border-bottom:1px solid #fff;">
                                        <p><?php echo $f->phrase;?></p>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <p class="text-primary mb-0"><i class='ti-help-alt'></i> <b>Business Operation :</b>
                            <?php echo $Works; ?>
                        </p>
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
                        <p class="font-weight-500">This is a <b class="text-info">line graph</b> of the <b>Selling
                                Price</b>
                            for BurgerByte
                            Enterprise in every stock.
                            It is the period time in a year to show <b>Selling Price</b> for every stock in
                            BurgerByte
                            Enterprise, page or app, etc.</p>
                        <div class="d-flex flex-wrap mb-5">
                            <div class="mr-5 mt-3">
                                <p class="text-muted">Stock</p>
                                <?php
                                 $query = "SELECT * FROM stock
                                 ORDER BY Stock_Id ASC";
                                 $stock = mysqli_query($dbc, $query);
                                 // Count the number of returned rows:
                                 $stock_num = mysqli_num_rows($stock);
                                 ?>
                                <h3 class="text-primary fs-30 font-weight-medium">
                                    <?php echo "$stock_num"?>
                                </h3>
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
                        <!-- Line Graph Selling Price Stock Report -->
                        <p align="center" class="mb-2 mb-xl-0"><b>Selling Pirce of Every Stock</b>
                        </p>
                        <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Bar Graph Sales Report -->
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Sales Report</p>
                        </div>
                        <p class="font-weight-500">This is <b class="text-info">bar-graph</b> of the <b>Total Sales</b>
                            for
                            BurgerByte
                            Enterprise in every month.
                            It is the period time in a year to show <b>Total Sales</b> for every month in
                            BurgerByte
                            Enterprise, page or app, etc.
                        </p>
                        <br />
                        <br />
                        <!-- Bar Graph Sales Report -->
                        <p align="center" class="mb-2 mb-xl-0"><b>Total Sales of Every Month</b>
                        </p>
                        <br />
                        <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                        <canvas id="graphCanvas"></canvas>
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
                            <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <!-- Detailed Invoices Report -->
                                        <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                            <div class="ml-xl-4 mt-3">
                                                <p class="card-title">Detailed Invoices</p>
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
                                                <h3 class="font-weight-500 mb-xl-4 text-primary">Total
                                                    Invoices</h3>
                                                <p align="justify" class="mb-2 mb-xl-0">This is <b
                                                        class="text-info">Total
                                                        Invoices</b> for
                                                    every
                                                    month in this year
                                                    based on <b class="text-success"><?php echo "$stock_num" ?>
                                                        Stock.</b>
                                                    This part lists the detailed sum sales for all stock in
                                                    every month
                                                    into a <b>Pie Chart</b>.
                                                    <b class="text-success"><i class='ti-arrow-up'></i>
                                                        Positve</b> or
                                                    <b class="text-danger"><i class='ti-arrow-down'></i>
                                                        Negative</b>
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
                                                            <th>Profit / Shot (<b class='text-success'>+</b>/<b
                                                                    class='text-danger'>-</b>)</th>
                                                            <th class="text-center">Comments</th>
                                                            <th class="text-right">Total Sales</th>
                                                            <?php
                                                            // Define the query:
                                                            $sql = "SELECT 
                                                            (Total - Total_Sales) AS Total_Shot,
                                                            MONTHNAME(Invoice_Date) AS month, 
                                                            SUM(Total_Sales) AS Total_Sales
                                                            FROM     invoice
                                                            GROUP BY MONTHNAME(Invoice_Date)
                                                            ORDER BY Invoice_Date";
                                                            $sales_month = mysqli_query($dbc,$sql);

                                                            // Count the number of returned rows:
                                                            $sales_num = mysqli_num_rows($sales_month);
                                                            if(mysqli_num_rows($sales_month) > 0)  
                                                            {  
                                                                while($row = mysqli_fetch_array($sales_month))  
                                                                {  
                                                            ?>
                                                            <tr>
                                                                <td class="text-muted">
                                                                    <?php echo $row["month"]; ?></td>

                                                                <td class="text-muted">
                                                                    RM <?php echo $row["Total_Shot"];?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                        $Comments = $row['Total_Shot']; // enter any number of your choice here
                                                                        if ($Comments > 0) // condition for positive numbers
                                                                        {
                                                                            echo  " <div align='center' class='text-success'><i class='ti-arrow-up'></i> Positive Sales</div>";
                                                                        } else if ($Comments < 0) // condition for negative number
                                                                        {
                                                                            echo " <div align='center' class='text-danger'><i class='ti-arrow-down'></i> Negative Sales</div>";
                                                                        } else
                                                                        {
                                                                            echo " <div align='center' class='text-warning'>Balance Sales</div>";
                                                                        } 
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <h5 class="font-weight-bold mb-0" align="right">
                                                                        RM
                                                                        <?php echo $row["Total_Sales"]; ?>
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
                                                    <p align="center" class="mb-2 mb-xl-0"><b>Total Sales of
                                                            Every
                                                            Month</b>
                                                    </p>
                                                    <div id="sales-legend" class="chartjs-legend mt-4 mb-2">
                                                    </div>

                                                    <canvas id="piechartInvoices"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="row">
                                        <!-- Detailed Invoices Report -->
                                        <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                            <div class="ml-xl-4 mt-3">
                                                <p class="card-title">Detailed Income</p>
                                                <?php
                                                // Define the Number of Invoice query:
                                                $sql = "SELECT  SUM(Net_Income) 
                                                from income";
                                                $income = $dbc->query($sql);
                                                //display data on web page
                                                ?>
                                                <h1 class="text-primary">
                                                    <?php 
                                                    while($row = mysqli_fetch_array($income)){
                                                        echo "RM ". $row['SUM(Net_Income)']; 
                                                    }?>
                                                </h1>
                                                <h3 class="font-weight-500 mb-xl-4 text-primary">Total
                                                    Income</h3>
                                                <p align="justify" class="mb-2 mb-xl-0">This is <b
                                                        class="text-info">Total
                                                        Income</b> for
                                                    every
                                                    month in this year
                                                    based on each of sales.
                                                    This part lists the detailed net income for all sales in
                                                    every month
                                                    into a <b>Pie Chart</b>.
                                                    <b class="text-success"><i class='ti-arrow-up'></i>
                                                        Positve</b> or
                                                    <b class="text-danger"><i class='ti-arrow-down'></i>
                                                        Negative</b>
                                                    Sales is happen when Net Income is not balance or equal
                                                    with Total Sales for all stock.
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
                                                            <th>Net Expenses</th>
                                                            <th class="text-center">Comments</th>
                                                            <th class="text-right">Total Income</th>
                                                            <?php
                                                            // Define the query:
                                                            $sql = "SELECT 
                                                            MONTHNAME(Income_Date) AS month, 
                                                            SUM(Net_Income) AS Net_Income,
                                                            SUM(Net_Expenses) AS Net_Expenses
                                                            FROM     income
                                                            GROUP BY MONTHNAME(Income_Date)
                                                            ORDER BY Income_Date";
                                                            $income_month = mysqli_query($dbc,$sql);

                                                            // Count the number of returned rows:
                                                            $income_num = mysqli_num_rows($income_month);
                                                            if(mysqli_num_rows($income_month) > 0)  
                                                            {  
                                                                while($row = mysqli_fetch_array($income_month))  
                                                                {  
                                                            ?>
                                                            <tr>
                                                                <td class="text-muted">
                                                                    <?php echo $row["month"]; ?></td>

                                                                <td class="text-muted">
                                                                    RM
                                                                    <?php echo number_format($row["Net_Expenses"],2); ?>
                                                                </td>

                                                                <td>
                                                                    <?php
                                                                        $number = $row['Net_Income']; // enter any number of your choice here
                                                                        if ($number > 0) // condition for positive numbers
                                                                        {
                                                                            echo  " <div align='center' class='text-success'><i class='ti-arrow-up'></i> Positive Income</div>";
                                                                        } else if ($number < 0) // condition for negative number
                                                                        {
                                                                            echo " <div align='center' class='text-danger'><i class='ti-arrow-down'></i> Negative Income</div>";
                                                                        } else
                                                                        {
                                                                            echo " <div align='center' class='text-warning'>Balance Income</div>";
                                                                        } 
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <h5 class="font-weight-bold mb-0" align="right">
                                                                        RM <?php echo $row["Net_Income"]; ?>
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
                                                    <p align="center" class="mb-2 mb-xl-0"><b>Total Income
                                                            of Every
                                                            Month</b>
                                                    </p>
                                                    <div id="sales-legend" class="chartjs-legend mt-4 mb-2">
                                                    </div>

                                                    <canvas id="piechartIncome"></canvas>
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
        </div>

        <!-- SECTION 4 -->
        <div class="row">
            <!-- Stock Purchase Table -->
            <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Purchase Stock</p>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="pl-0  pb-2 border-bottom">Owner Code</th>
                                                <th class="border-bottom pb-2 text-center">Purchase Date
                                                </th>
                                                <th class="border-bottom pb-2 text-center">Purchase Status
                                                </th>
                                                <th class="border-bottom pb-2 text-center"></th>
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
                                                        <a href="Purchase.php"
                                                            class="btn btn-outline-info btn-sm editbtn"><i
                                                                class="bi bi-three-dots-vertical"></i>More</a>
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
            <!-- Stock In Table -->
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Stock In</p>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-borderless" id="table">
                                        <thead>
                                            <tr>
                                                <th class="pl-0  pb-2 border-bottom">Stock Name</th>
                                                <th class="border-bottom pb-2 text-center">Categories</th>
                                                <th class="border-bottom pb-2 text-center">Availability</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $count_query = "SELECT count(*) as allcount 
                                                        FROM stock s JOIN category c 
                                                        ON s.Category_id = c.Category_id
                                                        ORDER BY Stock_Id ASC";
                                        $count_result = mysqli_query($dbc,$count_query);
                                        $count_fetch = mysqli_fetch_array($count_result);
                                        $postCount = $count_fetch['allcount'];
                                        $limit = 8;

                                        $query = "SELECT *
                                        FROM stock s JOIN category c ON s.Category_id = c.Category_id 
                                        ORDER BY Stock_Id ASC LIMIT 0,".$limit;	
                                        $result = mysqli_query($dbc,$query);
                                        if ($result->num_rows > 0) {
                                            while($row = mysqli_fetch_assoc($result)){ 
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
                                                        <?php echo $row["Quantity_In"]; ?> pieces
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php  
                                            }  
                                        }  
                                        ?>
                                    </table>
                                    <div class="loadmore" align="right">
                                        <p class="mb-0">
                                            <a class="text-info" id="loadBtn" value="Load More">View More</a>
                                        </p>
                                        <input type="hidden" id="row" value="0">
                                        <input type="hidden" id="postCount" value="<?php echo $postCount; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Human Resources Table -->
            <div class="col-md-4 stretch-card grid-margin">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Human Resources</p>
                                <div class="charts-data">
                                    <div class="mt-3">
                                        <p class="mb-0">Attendances</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-inf0" role="progressbar" style="width: 65%"
                                                    aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <?php
                                            // Define the query:
                                            $query = "SELECT *
                                            FROM attendance a, employee e
                                            WHERE a.Employee_Code = e.Profile_Id
                                            ORDER BY  a.Attendance_Id ASC";
                                            $attendance = mysqli_query($dbc, $query);

                                            // Count the number of returned rows:
                                            $attendance_num = mysqli_num_rows($attendance);
                                            ?>
                                            <p class="mb-0"><b><?php echo "$attendance_num"?>
                                                    Registrations</b></p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="mb-0">Commissions</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: 10%" aria-valuenow="35" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <?php
                                            $query = "SELECT *
                                            FROM comission c, employee e, profile p
                                            WHERE c.Employee_Code = e.Profile_Id AND c.Employee_Code = p.Profile_Id
                                            ORDER BY c.Commission_Id ASC";
                                            $commission = mysqli_query($dbc, $query);
                                            
                                            // Count the number of returned rows:
                                            $commission_num = mysqli_num_rows($commission);
                                            ?>
                                            <p class="mb-0"><b><?php echo "$commission_num"?>
                                                    Registrations</b></p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="mb-0">Medical Leaves</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: 15%" aria-valuenow="48" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <?php
                                            // Define the query:
                                            $query = 'SELECT *
                                            FROM leaves l, employee e , profile p 
                                            WHERE l.Employee_Code = e.Profile_Id AND l.Employee_Code = p.Profile_Id 
                                            ORDER BY l.Leave_Id ASC';
                                            $leave = @mysqli_query($dbc, $query);

                                            // Count the number of returned rows:
                                            $leave_num = mysqli_num_rows($leave);
                                            ?>
                                            <p class="mb-0"><b><?php echo "$leave_num"?> Registrations</b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="mb-0">Category</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-primary " role="progressbar"
                                                    style="width: 75%" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <?php
                                            // Define the Number of Category query:
                                            $query = "SELECT * FROM category
                                            ORDER BY Category_Id ASC";
                                            $category = mysqli_query($dbc, $query);
                                            
                                            // Count the number of returned rows:
                                            $category_num = mysqli_num_rows($category);
                                            
                                            ?>
                                            <p class="mb-0"><b><?php echo "$category_num"?>
                                                    Registrations</b></p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="mb-0">Stock</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-warning " role="progressbar"
                                                    style="width: 90%" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <p class="mb-0"><b><?php echo "$stock_num"?> Registrations</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Net Expenses -->
                    <div class="col-md-12 stretch-card grid-margin grid-margin-md-0">
                        <div class="card data-icon-card-primary">
                            <div class="card-body">
                                <p class="card-title text-white">Net Expenses </p>
                                <div class="row">
                                    <div class="col-8 text-white">
                                        <?php
                                        // Define the Number of Income query:
                                        $sql = "SELECT  SUM(Net_Expenses) FROM income";
                                        $income = $dbc->query($sql);
                                        //display data on web page
                                        ?>
                                        <h3><?php 
                                            while($row = mysqli_fetch_array($income)){
                                            echo "RM ". $row['SUM(Net_Expenses)']; 
                                            }?> / year
                                        </h3>
                                        <p class="text-white font-weight-500 mb-0">The <b>Net Expenses</b>
                                            of sessions
                                            within
                                            the date range. It is calculated as the sum for Net Expenses
                                            over in this
                                            year. </p>
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
                                        <p class="mb-0"><b><?php echo $row["Employee_Code"]; ?></b></p>
                                        <small><a href="https://wa.me/+6<?php echo $row['Phone'];?>"
                                                target="_blank"><?php echo $row["Phone"]; ?></a></small> |
                                        <small><a
                                                href="mailto:'.strtolower<?php echo $row["Email"]; ?>"><?php echo $row["Email"]; ?></a></small>
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

        <script>
        // SCRIPT FOR LINE CHART - STOCK
        $(document).ready(function() {
            lineChart();
        });

        function lineChart() {
            {
                $.post("../Database/Chart/Stock.php",
                    function(data) {
                        console.log(data);
                        var Stock_Name = [];
                        var Selling_Price = [];
                        var barColors = [
                            "rgba(75,73,172, 1.0)",
                            "rgba(75,73,172, 0.8)",
                            "rgba(75,73,172, 0.6)",
                            "rgba(75,73,172, 0.4)",
                            "rgba(75,73,172, 0.2)"
                        ];

                        for (var i in data) {
                            Stock_Name.push(data[i].Stock_Name);
                            Selling_Price.push(data[i].Selling_Price);
                        }

                        var chartdata = {
                            labels: Stock_Name,
                            datasets: [{
                                label: 'Stock Name',
                                backgroundColor: barColors,
                                borderColor: '#4B49AC',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: Selling_Price,
                                x: 100
                            }]
                        };


                        var graphTarget = $("#lineChart");

                        var barGraph = new Chart(graphTarget, {
                            type: 'line',
                            data: chartdata
                        });
                    });
            }
        }

        // SCRIPT FOR BAR CHART - SALES
        $(document).ready(function() {
            barChart();
        });

        function barChart() {
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
                                x: 100
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

        // SCRIPT FOR PIE CHART 1 - INVOICES 1
        $(document).ready(function() {
            pieChart1();
        });

        function pieChart1() {
            {
                $.post("../Database/Chart/Invoice.php",
                    function(data) {
                        console.log(data);
                        var Invoice_Date = [];
                        var Total_Sales = [];
                        var barColors = [
                            "rgba(75,73,172, 1.0)",
                            "rgba(75,73,172, 0.8)",
                            "rgba(75,73,172, 0.6)",
                            "rgba(75,73,172, 0.4)",
                            "rgba(75,73,172, 0.2)"
                        ];


                        for (var i in data) {
                            Invoice_Date.push(data[i].Invoice_Date);
                            Total_Sales.push(data[i].Total_Sales);
                        }

                        var chartdata = {
                            labels: Invoice_Date,
                            datasets: [{
                                label: 'Total Sales RM',
                                backgroundColor: barColors,
                                borderColor: '#4B49AC',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: Total_Sales,
                                x: 100
                            }]
                        };


                        var graphTarget = $("#piechartInvoices");

                        var barGraph = new Chart(graphTarget, {
                            type: 'doughnut',
                            data: chartdata
                        });
                    });
            }
        }

        // SCRIPT FOR PIE CHART 2 - INVOICES 2
        $(document).ready(function() {
            pieChart2();
        });

        function pieChart2() {
            {
                $.post("../Database/Chart/Income.php",
                    function(data) {
                        console.log(data);
                        var Income_Date = [];
                        var Net_Income = [];
                        var barColors = [
                            "rgba(75,73,172, 1.0)",
                            "rgba(75,73,172, 0.8)",
                            "rgba(75,73,172, 0.6)",
                            "rgba(75,73,172, 0.4)",
                            "rgba(75,73,172, 0.2)"
                        ];


                        for (var i in data) {
                            Income_Date.push(data[i].Income_Date);
                            Net_Income.push(data[i].Net_Income);
                        }

                        var chartdata = {
                            labels: Income_Date,
                            datasets: [{
                                label: 'Total Net Income RM',
                                backgroundColor: barColors,
                                borderColor: '#4B49AC',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: Net_Income,
                                x: 100
                            }]
                        };


                        var graphTarget = $("#piechartIncome");

                        var barGraph = new Chart(graphTarget, {
                            type: 'doughnut',
                            data: chartdata
                        });
                    });
            }
        }

        // LOAD MORE DATA FOR STOCK 
        $(document).ready(function() {
            $(document).on('click', '#loadBtn', function() {
                var row = Number($('#row').val());
                var count = Number($('#postCount').val());
                var limit = 8;
                row = row + limit;
                $('#row').val(row);
                $("#loadBtn").val('Loading...');

                $.ajax({
                    type: 'POST',
                    url: '../Database/Chart/Load.php',
                    data: 'row=' + row,
                    success: function(data) {
                        var rowCount = row + limit;
                        $('#table').append(data);
                        if (rowCount >= count) {
                            $('#loadBtn').css("display",
                                "none");
                        } else {
                            $("#loadBtn").val('Load More');
                        }
                    }
                });
            });
        });
        </script>

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

        <!-- Plugin Chart.js for this page -->
        <script type="text/javascript" src="../js/Chart.min.js"></script>
        <!-- End Chart.js for this page-->
        <!--========== INCLUDE FOOTER ==========-->
        <?php include('../partials/Footer.html'); ?>