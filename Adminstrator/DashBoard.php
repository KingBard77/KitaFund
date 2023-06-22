<!--========== DASHBOARD ==========-->
<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php 
// This function outputs theoretical HTML
// for adding ads to a Web page.

$page_title = 'Dashboard';
include '../partials/Navbar - Adminstrator.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Adminstrator.php';
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
                        <h3 class="font-weight-bold">Welcome <?php echo" Mrs. {$_SESSION["Username"]} "?></h3>
                        <h6 class="font-weight-normal mb-0">You're in <b>KitaFund System!</b> You have <span
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
                    <img src="../Images/Dashboard/Menu.jpg" class="rounded" alt="people">
                </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-12 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card mb-3">
                            <div class="card-body">
                                <?php
                                // Define the Weather Forecasting:
                                // Define the Weather Forecasting:
                                // $apiKey = "233cf9a6f1dcf621894d4eb07784dcb6";
                                // $cityId = "1735268";
                                // $api_url = "http://api.openweathermap.org/data/2.5/forecast?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;
                                $cache_file = 'data.json';
                                if(file_exists($cache_file)){
                                    $data = json_decode(file_get_contents($cache_file));
                                }else{
                                    $api_url = 'https://content.api.nytimes.com/svc/weather/v2/current-and-seven-day-forecast?';
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
                                                <?php echo ' Changlun (Kedah / '.$current->country.')';?>
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
                                    $Works ='<span>Prepare to come <b class="text-success"><i class="ti-alarm-clock"></i> 4.30 PM early</b> than <b>5.00 PM</b> usual into a KitaFund Ent.</span></p>';
                                    $Prediction ='<span>Prepare a <b class="text-success"><i class="ti-arrow-up"></i> 40%</b> awareness funds and donation into a KitaFund Ent.</span></p>';
                                }
                                if ($current->description == "Partly cloudy"){
                                    $Works ='<span>Prepare to come <b class="text-info"><i class="ti-alarm-clock"></i> 4.45 PM early</b> than <b>5.00 PM</b> usual into a KitaFund Ent.</span></p>';
                                    $Prediction ='<span>Prepare a <b class="text-info"><i class="ti-arrow-up"></i> 25%</b> awareness funds and donation into a KitaFund Ent.</span></p>';
                                }
                                if ($current->description == "Cloudy"){
                                    $Works ='<span>Prepare to come <b class="text-warning"><i class="ti-alarm-clock"></i> 5.15 PM late</b> than <b>5.00 PM</b> usual into a KitaFund Ent.</span></p>';
                                    $Prediction ='<span>Prepare a <b class="text-warning"><i class="ti-arrow-up"></i> 10%</b> awareness funds and donation into a KitaFund Ent.</span></p>';
                                }
                                if ($current->description == "Mostly cloudy"){
                                    $Works ='<span>Prepare to come <b class="text-danger"><i class="ti-alarm-clock"></i> 5.30 PM late</b> than <b>5.00 PM</b> usual into a KitaFund Ent.</span></p>';
                                    $Prediction ='<span>Prepare a <b class="text-danger"><i class="ti-arrow-down"></i> -10%</b> awareness funds and donation into a KitaFund Ent.</span></p>';
                                }
                                if ($current->description == "Raining"){
                                    $Works ='<span>Prepare to come <b class="text-secondary"><i class="ti-alarm-clock"></i> 6.00 PM late</b> than <b>5.00 PM</b> usual into a KitaFund Ent.</span></p>';
                                    $Prediction ='<span>Prepare a <b class="text-secondary"><i class="ti-arrow-down"></i> -20%</b> awareness funds and donation into a KitaFund Ent.</span></p>';
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
                                // Define the Number of Donator query:
                                $query = "SELECT * FROM donator
                                ORDER BY donator_id ASC";
                                $donator = mysqli_query($dbc, $query);
                                
                                // Count the number of returned rows:
                                $donator_num = mysqli_num_rows($donator);
                                
                                ?>
                                <p class="mb-4">Total Donators</p>
                                <p class="fs-30 mb-2"><?php echo "$donator_num" ?></p>
                                <p>10.00% (30 days)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <?php
                                // Define the Number of Donator Amount query:
                                $sql = "SELECT  SUM(amount) from donator";
                                $amount = $dbc->query($sql);
                                //display data on web page
                                ?>
                                <p class="mb-4">Total Amount</p>
                                <p class="fs-30 mb-2">
                                    <?php 
                                    while($row = mysqli_fetch_array($amount)){
                                        echo "RM ". $row['SUM(amount)']; 
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
                                // Define the Number of Volunteer query:
                                $query = "SELECT * FROM volunteer
                                ORDER BY volunteer_id ASC";
                                $volunteer = @mysqli_query($dbc, $query);

                                // Count the number of returned rows:
                                $volunteer_num = mysqli_num_rows($volunteer);
                                ?>
                                <p class="mb-4">Number of Volunteer</p>
                                <p class="fs-30 mb-2"><?php echo "$volunteer_num" ?></p>
                                <p>2.00% (30 days)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <?php
                                // Define the Number of Contact query:
                                $sql = "SELECT  SUM(contact_subject) FROM contact";
                                $contact = $dbc->query($sql);
                                //display data on web page
                                ?>
                                <p class="mb-4">Number of Contact</p>
                                <p class="fs-30 mb-2">
                                    <?php 
                                    while($row = mysqli_fetch_array($contact)){
                                    echo $row['SUM(contact_subject)']; 
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
                            for KitaFund
                            NGO Haluan Kedah.
                            It is the period time in a week to <br>
                            show prediction of <b>Weather</b> every day in KitaFund
                            page or app, etc.</p>
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
                        <br />
                        <p class="text-primary mb-0"><i class='ti-help-alt'></i> <b>KitaFund Ent Operation :</b>
                            <?php echo $Works; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 2 -->
        <div class="row">
            <!-- Lined Graph Summary Report -->
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">KitaFund Details</p>
                        <p class="font-weight-500">This is a <b class="text-info">line graph</b> of the <b>Total
                                Volunteer</b>
                            for KitaFund
                            NGO Haluan Kedah in every Total
                            Volunteer.
                            It is the period time in a year to show <b>Total
                                Volunteer</b> for every Donators in
                            KitaFund
                            , page or app, etc.</p>
                        <div class="d-flex flex-wrap mb-5">
                            <div class="mr-5 mt-3">
                                <p class="text-muted">Donators</p>
                                <?php
                                 $query = "SELECT * FROM donator
                                 ORDER BY donator_id ASC";
                                 $donator = mysqli_query($dbc, $query);
                                 // Count the number of returned rows:
                                 $donator_num = mysqli_num_rows($donator);
                                 ?>
                                <h3 class="text-primary fs-30 font-weight-medium">
                                    <?php echo "$donator_num"?>
                                </h3>
                            </div>
                            <div class="mr-5 mt-3">
                                <p class="text-muted">Volunteer</p>
                                <?php
                                 $query = "SELECT * FROM volunteer
                                 ORDER BY volunteer_id ASC";
                                 $volunteer = mysqli_query($dbc, $query);
                                 // Count the number of returned rows:
                                 $volunteer_num = mysqli_num_rows($volunteer);
                                 ?>
                                <h3 class="text-primary fs-30 font-weight-medium">
                                    <?php echo "$volunteer_num"?>
                                </h3>
                            </div>
                            <div class="mr-5 mt-3">
                                <p class="text-muted">Amount</p>
                                <?php
                                // Define the query:
                                $sql = "SELECT  SUM(amount) from donator";
                                $amount = $dbc->query($sql);
                                //display data on web page
                                ?>
                                <h3 class="text-primary fs-30 font-weight-medium">
                                    <?php 
                                    while($row = mysqli_fetch_array($amount)){
                                        echo "RM ". $row['SUM(amount)']; 
                                    }?>
                                </h3>
                            </div>
                            <div class="mt-3">
                                <p class="text-muted">Percentage</p>
                                <?php
                                // Define the query:
                                $sql = "SELECT  SUM(amount) from donator";
                                $amount = $dbc->query($sql);
                                //display data on web page
                                ?>
                                <h3 class="text-primary fs-30 font-weight-medium">
                                    <?php 
                                    while($row = mysqli_fetch_array($amount)){
                                        echo "RM ". $row['SUM(amount)']; 
                                    }?>
                                </h3>
                            </div>
                        </div>
                        <!-- Line Graph Total Volunteer Report -->
                        <p align="center" class="mb-2 mb-xl-0"><b>Total Volunteer of Every Donators</b>
                        </p>
                        <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Bar Graph Donation Amount Report -->
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">KitaFund Details</p>
                        </div>
                        <p class="font-weight-500">This is a <b class="text-info">bar graph</b> of the <b>Donation
                                Amount</b>
                            for KitaFund
                            NGO Haluan Kedah in every Donation Amount.
                            It is the period time in a year to show <b>Donation
                                Amount</b> for every Donators in
                            KitaFund
                            , page or app, etc.</p>
                        </p>
                        <br />
                        <br />
                        <!-- Line Graph Donation Amount Report -->
                        <p align="center" class="mb-2 mb-xl-0"><b>Total Amount Donation of Every Donators</b>
                        </p>
                        <br />
                        <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                        <canvas id="graphCanvas"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 4 -->
        <div class="row">
            <!-- Contact Table -->
            <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Contact Details</p>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom pb-2 text-left">Name</th>
                                                <th class="border-bottom pb-2 text-center">Subject
                                                </th>
                                                <th class="border-bottom pb-2 text-center">Message
                                                </th>
                                                <th class="border-bottom pb-2 text-center"></th>
                                            </tr>
                                        </thead>
                                        <?php
                                        // Define the query:
                                        $query = "SELECT *
                                        FROM contact 
                                        ORDER BY contact_id ASC";
                                        $contact = mysqli_query($dbc, $query);

                                        // Count the number of returned rows:
                                        $contact_num = mysqli_num_rows($contact);
                                        if(mysqli_num_rows($contact) > 0)  
                                        {  
                                            while($row = mysqli_fetch_array($contact))  
                                            { 
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $row["contact_name"]; ?></td>

                                                <td>
                                                    <div class="col text-center">
                                                        <?php echo $row["contact_subject"]; ?>
                                                    </div>
                                                </td>

                                                <td class="font-weight-medium">
                                                    <?php
                                                    $Status = '';
                                                    if($row["contact_remark"] == 'Hold'){
                                                        $Status ='<label class="badge badge-warning">Hold</label>';
                                                    }
                                                    if($row["contact_remark"] == 'Proceed'){
                                                        $Status ='<label class="badge badge-success">Proceed</label>';
                                                    }
                                                    if($row["contact_remark"] == 'Reject'){
                                                        $Status ='<label class="badge badge-danger">Reject</label>';
                                                    }
                                                    ?>
                                                    <div class="text-center"><?php echo $Status ?></div>
                                                </td>
                                                <td>
                                                    <div class="col text-center">
                                                        <a href="Contact.php"
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
            <!-- Event Table -->
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Event</p>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-borderless" id="table">
                                        <thead>
                                            <tr>
                                                <th class="pl-0  pb-2 border-bottom">Event Name</th>
                                                <th class="border-bottom pb-2 text-center">Start Date</th>
                                                <th class="border-bottom pb-2 text-center">End Date</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $count_query = "SELECT *
                                                        FROM event
                                                        ORDER BY id ASC";
                                        $count_result = mysqli_query($dbc,$count_query);
                                        $count_fetch = mysqli_fetch_array($count_result);
                                        $limit = 8;

                                        $query = "SELECT *
                                        FROM event
                                        ORDER BY id ASC LIMIT 0,".$limit;	
                                        $result = mysqli_query($dbc,$query);
                                        if ($result->num_rows > 0) {
                                            while($row = mysqli_fetch_assoc($result)){ 
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td class="pl-0"><?php echo $row["title"]; ?></td>
                                                <td>
                                                    <p class="mb-0">
                                                    <div class="col text-center"><span class="font-weight-bold mr-2">
                                                            <?php $start_event = strtotime ($row['start']);?>
                                                            <?php echo date('d M, Y', $start_event)?></span>
                                                    </div>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="mb-0">
                                                    <div class="col text-center"><span class="font-weight-bold mr-2">
                                                            <?php $end_event = strtotime ($row['end']);?>
                                                            <?php echo date('d M, Y', $end_event)?></span>
                                                    </div>
                                                    </p>
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
                                        <p class="mb-0">Donators</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-inf0" role="progressbar" style="width: 65%"
                                                    aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <?php
                                            // Define the query:
                                            $query = "SELECT *
                                            FROM donator
                                            ORDER BY donator_id ASC";
                                            $donate = mysqli_query($dbc, $query);

                                            // Count the number of returned rows:
                                            $donate_num = mysqli_num_rows($donate);
                                            ?>
                                            <p class="mb-0"><b><?php echo "$donate_num"?>
                                                    Registrations</b></p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="mb-0">Volunteer</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: 10%" aria-valuenow="35" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <?php
                                            $query = "SELECT *
                                            FROM volunteer
                                            ORDER BY volunteer_id ASC";
                                            $volunteer = mysqli_query($dbc, $query);
                                            
                                            // Count the number of returned rows:
                                            $volunteer_num = mysqli_num_rows($volunteer);
                                            ?>
                                            <p class="mb-0"><b><?php echo "$volunteer_num"?>
                                                    Registrations</b></p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="mb-0">Contact</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: 15%" aria-valuenow="48" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <?php
                                            // Define the query:
                                            $query = 'SELECT *
                                            FROM contact
                                            ORDER BY contact_id ASC';
                                            $contact = @mysqli_query($dbc, $query);

                                            // Count the number of returned rows:
                                            $contact_num = mysqli_num_rows($contact);
                                            ?>
                                            <p class="mb-0"><b><?php echo "$contact_num"?> Registrations</b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="mb-0">Event</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-primary " role="progressbar"
                                                    style="width: 75%" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <?php
                                            // Define the Number of Event query:
                                            $query = "SELECT * FROM event
                                            ORDER BY id ASC";
                                            $event = mysqli_query($dbc, $query);
                                            
                                            // Count the number of returned rows:
                                            $event_num = mysqli_num_rows($event);
                                            
                                            ?>
                                            <p class="mb-0"><b><?php echo "$event_num"?>
                                                    Registrations</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Donation -->
                    <div class="col-md-12 stretch-card grid-margin grid-margin-md-0">
                        <div class="card data-icon-card-primary">
                            <div class="card-body">
                                <p class="card-title text-white">Total Donation</p>
                                <div class="row">
                                    <div class="col-8 text-white">
                                        <?php
                                        // Define the Number of Donator query:
                                        $sql = "SELECT  SUM(amount) FROM donator";
                                        $donator = $dbc->query($sql);
                                        //display data on web page
                                        ?>
                                        <h3><?php 
                                            while($row = mysqli_fetch_array($donator)){
                                            echo "RM ". $row['SUM(amount)']; 
                                            }?> / year
                                        </h3>
                                        <p class="text-white font-weight-500 mb-0">The <b>Total Donation</b>
                                            of sessions
                                            within
                                            the date range. It is calculated as the sum for Total Donation Amount
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
                $.post("../Database/Chart/Volunteer.php",
                    function(data) {
                        console.log(data);
                        var volunteer_date = [];
                        var volunteer_remark = [];
                        var barColors = [
                            "rgba(198,107,0, 1.0)",
                            "rgba(198,107,0, 0.8)",
                            "rgba(198,107,0, 0.6)",
                            "rgba(198,107,0, 0.4)",
                            "rgba(198,107,0, 0.2)"
                        ];

                        for (var i in data) {
                            volunteer_date.push(data[i].month);
                            volunteer_remark.push(data[i].volunteer_remark);
                        }

                        var chartdata = {
                            labels: volunteer_date,
                            datasets: [{
                                label: 'Total Volunteer',
                                backgroundColor: barColors,
                                borderColor: '#c66b00',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: volunteer_remark,
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

        // SCRIPT FOR BAR CHART - DONATION
        $(document).ready(function() {
            barChart();
        });

        function barChart() {
            {
                $.post("../Database/Chart/Donation.php",
                    function(data) {
                        console.log(data);
                        var donator_date = [];
                        var amount = [];
                        var barColors = [
                            "rgba(198,107,0, 1.0)",
                            "rgba(198,107,0, 0.8)",
                            "rgba(198,107,0, 0.6)",
                            "rgba(198,107,0, 0.4)",
                            "rgba(198,107,0, 0.2)"
                        ];


                        for (var i in data) {
                            donator_date.push(data[i].month);
                            amount.push(data[i].amount);
                        }

                        var chartdata = {
                            labels: donator_date,
                            datasets: [{
                                label: 'Total Donation',
                                backgroundColor: barColors,
                                borderColor: '#c66b00',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: amount,
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
                            "rgba(198,107,0, 1.0)",
                            "rgba(198,107,0, 0.8)",
                            "rgba(198,107,0, 0.6)",
                            "rgba(198,107,0, 0.4)",
                            "rgba(198,107,0, 0.2)"
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
                                borderColor: '#c66b00',
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
                            "rgba(198,107,0, 1.0)",
                            "rgba(198,107,0, 0.8)",
                            "rgba(198,107,0, 0.6)",
                            "rgba(198,107,0, 0.4)",
                            "rgba(198,107,0, 0.2)"
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
                                borderColor: '#c66b00',
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