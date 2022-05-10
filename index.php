<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        BurgerByte
    </title>

    <!-- Plugin fonts for this page -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,900&display=swap"
        rel="stylesheet">
    <!-- End plugin fonts for this page -->

    <!-- Plugin css for this page -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/index/style.css">
    <!-- End plugin css for this page -->

    <!-- endinject -->
    <link rel="shortcut icon" href="Images/Icon.png">

    <script src="https://code.iconify.design/2/2.2.0/iconify.min.js"></script>
</head>

<body>
    <div class="container" style="background-image: url(./Images/Index/Background.jpg);">
        <div class="nav">
            <div class="menu" onclick="openNav()">
                <div class="hamburger"></div>
            </div>
            <div class="logo">
                BURGER.<span style="color: #e29f01;">BYTE</span>
            </div>
            <div class="cart">
                <a class="nav-link text-white" href="index.php">
                    <span class="iconify" data-icon="majesticons:burger-line"></span>
                </a>
            </div>
        </div>
        <div id="myNav" class="nav-overlay">
            <div class="nav-overlay-content">
                <a href="#">Services</a>
                <a href="#">Contact</a>
            </div>
        </div>
        <div class="sci">
            <i class='bx bxl-facebook-circle'></i>
            <i class='bx bxl-instagram-alt'></i>
            <i class='bx bxl-youtube'></i>
            <i class='bx bxl-twitter'></i>
        </div>
        <div class="fashion">
            BURGER.<span style="color: #e29f01;">BYTE</span>
        </div>
        <div class="copyright">
            Copyright © 2022. BurgerByte <a href="" target="_blank">
                All rights reserved.</a>
        </div>
        <div class="slide-control">
            <i class='bx bxs-right-arrow'></i>
        </div>
        <div class="overlay"></div>
        <div class="col-5" style="z-index: 97;">
            <div class="info">
                <!-- info 1 -->
                <div class="product-info">
                    <h1>
                        INVEN<span style="color: #e29f01;">TORY</span>
                    </h1>
                    <h1>
                        <span style="color: #e29f01;">SYS</span>TEM
                    </h1>
                    <span>
                        Collection 2022
                    </span>
                    <p>
                        BurgerByte is one of the businesses that operate on Food Street at Seri Iskandar, Perak.
                        BurgerByte serves different types of menu Burger such as Meat, Chicken, Beef, and others,
                        including Crispy Chicken Burger with top demand.
                        This system is
                        focusing on both user Owners & Employees to manage the daily business activities to maintain
                        future growth.
                    </p>
                </div>
                <!-- end info 1 -->
                <!-- info 2 -->
                <div class="product-info">
                    <h1>
                        <span style="color: #e29f01;">OWN</span>ER
                    </h1>
                    <h1>
                        SI<span style="color: #e29f01;">DE</span>
                    </h1>
                    <span>
                        Owner Side
                    </span>
                    <p>
                        Only one owner login is supported at this time. This means if you're are an owner you have
                        priority to access the BurgerByte Inventory Management System. You will need to enter a Username
                        and Password to log in to the system.
                    </p>
                    <button>
                        <a href="Adminstrator/Login_Owner.php" style="text-decoration: none" target="_blank">
                            <span style="color: #e29f01;">Login</span>
                        </a>
                    </button>
                </div>
                <!-- end info 2 -->
                <!-- info 3 -->
                <div class="product-info">
                    <h1>
                        <span style="color: #e29f01;">EMPL</span>OYEE
                    </h1>
                    <h1>
                        <span style="color: #e29f01;">SI</span>DE
                    </h1>
                    <span>
                        Employee Side
                    </span>
                    <p>
                        Multiple employee logins are supported at this time. This means if you're are an employee you
                        have priority to access the BurgerByte Inventory Management System.
                        You will need to enter an Employee Code and Password to log in to the system.
                    </p>
                    <button>
                        <a href="Employee/Login_Employee.php" style="text-decoration: none" target="_blank">
                            <span style="color: #e29f01;">Login</span>
                        </a>
                    </button>
                </div>
                <!-- end info 3 -->
                <!-- info 4 -->
                <div class="product-info">
                    <h1>
                        <span style="color: #e29f01;">ABO</span>UT
                    </h1>
                    <h1>
                        U<span style="color: #e29f01;">S</span>
                    </h1>
                    <span>
                        Collection 2020
                    </span>
                    <p>
                        Do you love a juicy burger? Even though hamburgers are a staple on the menu of most fast-food
                        restaurants, an occasional single-patty burger can be part of a nutritious diet.
                        Currently, everyday employee must submit the list of ordering raw materials required, calculate
                        the total daily sales, and then submit it to the owner in the paper.
                        In the future, the system is focused on employees and owners, which could give the business many
                        benefits in preventing excess stock, wrong calculation of total sales, and multiple salaries per
                        day.
                    </p>
                </div>
                <!-- end info 4 -->
            </div>
        </div>
        <div class="col-7">
            <div class="slider">
                <div class="slide">
                    <div class="img-holder" style="background-image: url(./Images/Index/carousel1.png);"></div>
                </div>
                <div class="slide">
                    <div class="img-holder" style="background-image: url(./Images/Index/carousel2.png)">
                    </div>
                </div>
                <div class="slide">
                    <div class="img-holder" style="background-image: url(./Images/Index/carousel3.png)"></div>
                </div>
                <div class="slide">
                    <div class="img-holder" style="background-image: url(./Images/Index/carousel4.png)"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom js for this page-->
    <script src="css/index/main.js"></script>
    <!-- End custom js for this page-->
</body>

</html>