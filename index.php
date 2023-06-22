<?php
// Set the page title and include the HTML header:
$page_title = 'Homepage';
include 'partials/Header.html';
require ('Database/Connection.php');
?>

<!-- Carousel Start -->
<div class="carousel">
    <div class="container-fluid">
        <div class="owl-carousel">
            <div class="carousel-item">
                <div class="carousel-img">
                    <img src="Images/Index/Header_1.jpg" alt="Image">
                </div>
                <div class="carousel-text">
                    <h1>Let's be kind for Asnaf </h1>
                    <p>
                        Fundraising under Non-Government Organization Haluan (NGO HALUAN)
                    </p>
                    <div class="carousel-btn">
                        <a class="btn btn-custom" href="donate.php">Donate Now</a>
                        <a class="btn btn-custom btn-play" data-toggle="modal"
                            data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-target="#videoModal">Watch
                            Video</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-img">
                    <img src="Images/Index/Header_2.jpg" alt="Image">
                </div>
                <div class="carousel-text">
                    <h1>Get Involved with sharing food together</h1>
                    <p>
                        The Kita Fund is a system ensure donation are channel quickly and efficiently in order to
                        help the NGO increase their ability to help more people.We believe that access to nutritious
                        food is a basic human right.
                    </p>
                    <div class="carousel-btn">
                        <a class="btn btn-custom" href="">Donate Now</a>
                        <a class="btn btn-custom btn-play" data-toggle="modal"
                            data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-target="#videoModal">Watch
                            Video</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-img">
                    <img src="Images/Index/Header_3.jpg" alt="Image">
                </div>
                <div class="carousel-text">
                    <h1>Bringing smiles to millions by filling a stomach</h1>
                    <p>
                        We believe that access to nutritious food is a basic human right.
                    </p>
                    <div class="carousel-btn">
                        <a class="btn btn-custom" href="">Donate Now</a>
                        <a class="btn btn-custom btn-play" data-toggle="modal"
                            data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-target="#videoModal">Watch
                            Video</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->

<!-- Video Modal Start-->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- 16:9 aspect ratio -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always"
                        allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Modal End -->


<!-- About Start -->
<div class="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-img" data-parallax="scroll" data-image-src="Images/Index/About.jpg"></div>
            </div>
            <div class="col-lg-6">
                <div class="section-header">
                    <p>Learn About Us</p>
                    <h2>Worldwide non-profit charity organization</h2>
                </div>
                <div class="about-tab">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#tab-content-1">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#tab-content-2">Mission</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#tab-content-3">Vision</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="tab-content-1" class="container tab-pane active">
                            The Kita Fund is a system ensure donation are channel quickly and efficiently in order
                            to help the NGO increase their ability to help more people.
                        </div>
                        <div id="tab-content-2" class="container tab-pane fade">
                            Encourage community to contribute and take part in distributing food supplies to those
                            who are facing shortage of food.
                        </div>
                        <div id="tab-content-3" class="container tab-pane fade">
                            We envision a community in which everyone has access to sufficient nutritious food.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Service Start -->
<div class="service">
    <div class="container">
        <div class="section-header text-center">
            <p>What We Do?</p>
            <h2>We believe that we can save more lifes with you</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="service-icon">
                        <i class="flaticon-diet"></i>
                    </div>
                    <div class="service-text">
                        <h3>Healthy Food</h3>
                        <p>Providing healthy food for asnaf as it it important to avoid disease because lack of
                            nutrition. Healthy food is good for their kids growth and stable mind.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="service-icon">
                        <i class="flaticon-water"></i>
                    </div>
                    <div class="service-text">
                        <h3>Pure Water</h3>
                        <p>Drinking pure water helps maintain the balance of body fluids. Your body is composed of
                            about 60% water. The functions of these bodily fluids include digestion, absorption,
                            circulation, creation of saliva, transportation of nutrients, and maintenance of body
                            temperature.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="service-icon">
                        <i class="flaticon-healthcare"></i>
                    </div>
                    <div class="service-text">
                        <h3>Jitra </h3>
                        <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="service-icon">
                        <i class="flaticon-education"></i>
                    </div>
                    <div class="service-text">
                        <h3> Groceries </h3>
                        <p> Provide groceries for asnaf family.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="service-icon">
                        <i class="flaticon-home"></i>
                    </div>
                    <div class="service-text">
                        <h3>Ready Food</h3>
                        <p>Collaborate Restaurant to cook and provide food for Asnaf to eat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="service-icon">
                        <i class="flaticon-social-care"></i>
                    </div>
                    <div class="service-text">
                        <h3>A bag full of snacks</h3>
                        <p> Providing a plastic of bag full with snacks so that Asnaf can fill their </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->


<!-- Facts Start -->
<div class="facts" data-parallax="scroll" data-image-src="Images/Index/Facts.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="flaticon-home"></i>
                    <div class="facts-text">
                        <h3 class="facts-plus" data-toggle="counter-up">150</h3>
                        <p> District</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="flaticon-charity"></i>
                    <div class="facts-text">
                        <h3 class="facts-plus" data-toggle="counter-up">400</h3>
                        <p>Volunteers</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="flaticon-kindness"></i>
                    <div class="facts-text">
                        <h3 class="facts-dollar" data-toggle="counter-up">10000</h3>
                        <p>Our Goal</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="flaticon-donation"></i>
                    <div class="facts-text">
                        <h3 class="facts-dollar" data-toggle="counter-up">5000</h3>
                        <p>Raised</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Facts End -->


<!-- Causes Start -->
<div class="causes">
    <div class="container">
        <div class="section-header text-center">
            <p>Popular Causes</p>
            <h2>Let's know about charity causes around the world</h2>
        </div>
        <div class="owl-carousel causes-carousel">
            <div class="causes-item">
                <div class="causes-img">
                    <img src="Images/Index/Causes_1.jpg" alt="Image">
                </div>
                <div class="causes-progress">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                            aria-valuemax="100">
                            <span>60%</span>
                        </div>
                    </div>
                    <div class="progress-text">
                        <p><strong>Raised:</strong> RM 9,000</p>
                        <p><strong>Goal:</strong> RM 10,000</p>
                    </div>
                </div>
                <div class="causes-text">
                    <h3>Jitra District</h3>
                    <p> Ongoing Campaign of earning for distributing cooked food </p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </div>
                <div class="causes-btn">
                    <a class="btn btn-custom">Learn More</a>
                    <a class="btn btn-custom">Donate Now</a>
                </div>
            </div>
            <div class="causes-item">
                <div class="causes-img">
                    <img src="Images/Index/Causes_2.jpg" alt="Image">
                </div>
                <div class="causes-progress">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="74" aria-valuemin="0"
                            aria-valuemax="100">
                            <span>74%</span>
                        </div>
                    </div>
                    <div class="progress-text">
                        <p><strong>Raised:</strong> RM 4,000</p>
                        <p><strong>Goal:</strong> RM 5,000</p>
                    </div>
                </div>
                <div class="causes-text">
                    <h3>Sungai Petani District</h3>
                    <p> Fundraiser for campign " A bag of happiness paint big smile" where it is giving a bag of
                        snacks for all asnaf student in the areas and each schools.</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </div>
                <div class="causes-btn">
                    <a class="btn btn-custom">Learn More</a>
                    <a class="btn btn-custom">Donate Now</a>
                </div>
            </div>
            <div class="causes-item">
                <div class="causes-img">
                    <img src="Images/Index/Causes_3.jpg" alt="Image">
                </div>
                <div class="causes-progress">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0"
                            aria-valuemax="100">
                            <span>55%</span>
                        </div>
                    </div>
                    <div class="progress-text">
                        <p><strong>Raised:</strong> RM 14,0000</p>
                        <p><strong>Goal:</strong> RM 10,000</p>
                    </div>
                </div>
                <div class="causes-text">
                    <h3> Changlun District </h3>
                    <p> Collecting donation for a program called " FOR YOU " it is for UUM STUDENT who is not being
                        able to purchase food they can take it from specific cafe for free and eat together with
                        their friends. </p>
                </div>
                <div class="causes-btn">
                    <a class="btn btn-custom">Learn More</a>
                    <a class="btn btn-custom">Donate Now</a>
                </div>
            </div>
            <div class="causes-item">
                <div class="causes-img">
                    <img src="Images/Index/Causes_4.jpg" alt="Image">
                </div>
                <div class="causes-progress">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0"
                            aria-valuemax="100">
                            <span>85%</span>
                        </div>
                    </div>
                    <div class="progress-text">
                        <p><strong>Raised:</strong> RM 7,000</p>
                        <p><strong>Goal:</strong> RM 10,000</p>
                    </div>
                </div>
                <div class="causes-text">
                    <h3>Baling District</h3>
                    <p> A programmed that is to help baling people that involved with flood , by providing food and
                        anything for give energy for them and ease their burdened</p>
                    &nbsp;
                    &nbsp;
                </div>
                <div class="causes-btn">
                    <a class="btn btn-custom">Learn More</a>
                    <a class="btn btn-custom">Donate Now</a
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Causes End -->


<!-- Event Start -->
<div class="event">
    <div class="container">
        <div class="section-header text-center">
            <p>Upcoming Events</p>
            <h2>Be ready for our upcoming charity events</h2>
        </div>
        <div class="row">
            <?php
            // Define the query:
            $query = "SELECT * FROM event
            ORDER BY id ASC";
            $event = mysqli_query($dbc, $query);

            // Count the number of returned rows:
            $event_num = mysqli_num_rows($event);
            if(mysqli_num_rows($event) > 0)  
            {  
                while($row = mysqli_fetch_array($event))  
                {  
            ?>
            <div class="col-lg-6">
                <div class="event-item">
                    <!-- <img src="Assets/img/event-1.jpg" alt="Image"> -->
                    <div class="event-content">
                        <div class="event-meta">
                            <?php $start_event = strtotime ($row['start']);?>
                            <p><i class="fa fa-calendar-alt"></i><b>Start: </b><?php echo date('d M, Y', $start_event)?>
                            </p>
                            <?php $end_event = strtotime ($row['end']);?>
                            <p><i class="fa fa-calendar-alt"></i><b>End: </b><?php echo date('d M, Y', $end_event)?></p>
                            <p><i class="fa fa-map-marker-alt"></i>Changlun, Kedah</p>
                        </div>
                        <div class="event-text">
                            <h3><?php echo $row["title"]; ?></h3>
                            <p align="justify">
                                Kelab Siswa HALUAN (HALUANSiswa) Negeri Kedah dengan kerjasama Biro HALUAN Palestin
                                telah mengadakan kutipan dana bantuan kecemasan Palestin di beberapa masjid sekitar
                                Sungai Petani.
                            </p>
                            <a class="btn btn-custom" href="#volunteer">Join Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php  
                    }  
                }  
                ?>
        </div>
    </div>
</div>
<!-- Event End -->


<!-- Team Start -->
<div class="team">
    <div class="container">
        <div class="section-header text-center">
            <p>Meet Our Team</p>
            <h2>Awesome guys behind our charity activities</h2>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-4">
                <div class="team-item">
                    <div class="team-img">
                        <img src="Images/Profile_Image/Profile_Image1.jpg" alt="Team Image">
                    </div>
                    <div class="team-text">
                        <h2>Teh Nur Khadijah</h2>
                        <p>Founder & CEO</p>
                        <div class="team-social">
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                            <a href=""><i class="fab fa-linkedin-in"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="team-item">
                    <div class="team-img">
                        <img src="Images/Profile_Image/Profile_Image3.jpg" alt="Team Image">
                    </div>
                    <div class="team-text">
                        <h2>Aishah Abdullah</h2>
                        <p>NGO Haluan Kedah</p>
                        <div class="team-social">
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                            <a href=""><i class="fab fa-linkedin-in"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->

<?php
// Set the Volunteer method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.

    if (empty($_POST['volunteer_name'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Volunteer Name.</b>';
    } else {
        $volunteer_name = trim($_POST['volunteer_name']);
    }

    if (empty($_POST['volunteer_email'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Volunteer Email.</b>';
    } else {
        $volunteer_email = trim($_POST['volunteer_email']);
    }

    if (empty($_POST['volunteer_description'])) {
        $errors[] = '<b style="color:black;">You forgot to enter your Volunteer Description.</b>';
    } else {
        $volunteer_description = trim($_POST['volunteer_description']);
    }

    if (empty($errors)) { // If everything's OK.

        // Make the query
        $query = "INSERT INTO volunteer (volunteer_name, volunteer_email, volunteer_description)
        VALUES ('$volunteer_name', '$volunteer_email', '$volunteer_description')";
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
                                <p class="mb-0">You are now add a new volunteer</p>
                            </div>
                            <a class="btn btn-light" href="index.php"><i class="ti-home mr-2"></i>Back to Volunteer Page</a>
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
                            <a class="btn btn-light" href="index.php"><i class="ti-home mr-2"></i>Back to Volunteer Page</a>                        
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
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <h1><strong>Error!</strong> </h1>
                                <p class="mb-0">The following error(s) occurred:</p><br/>';
                                foreach ($errors as $msg) { // Print each error.
                                    echo " - $msg<br />\n";
                                }
                                echo '
                                </p><p class="mb-0">Please try again.</p><p><br /></p>
                            </div>
                            <a class="btn btn-light" href="index.php"><i class="ti-home mr-2"></i>Back to Volunteer Page</a> 
                        </div>
                    </div>
                </div>';
    } // End of if (empty($errors)) IF.
    mysqli_close($dbc); // Close the database connection.
    include 'partials/Footer.php';
    exit();

} // End of the main Submit conditional.
?>

<!-- Volunteer Start -->
<div class="volunteer" data-parallax="scroll" data-image-src="Assets/img/volunteer.jpg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="volunteer-form">
                    <form action="index.php" method="post">
                        <div class="control-group">
                            <input type="text" class="form-control" placeholder="Name" name="volunteer_name"
                                required="required" />
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" placeholder="Email" name="volunteer_email"
                                required="required" />
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" placeholder="Why you want to become a volunteer?"
                                name="volunteer_description" required="required"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-custom" type="submit">Become a volunteer</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="volunteer-content">
                    <div class="section-header">
                        <p>Become A Volunteer</p>
                        <h2>Let’s make a difference in the lives of others</h2>
                    </div>
                    <div class="volunteer-text">
                        <p>
                            WE HEAR YOUR INTENTION TO HELP NOT ONLY BY MONEY BUT ALSO WITH YOUR PRECIOUS ENERGY.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Volunteer End -->


<!-- Footer Start -->
<?php
// Set the page title and include the HTML header:
include 'partials/Footer.php';
?>
<!-- Footer End -->

</body>

</html>