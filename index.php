<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BurgerByte</title>
    <!-- Custom CSS Link -->
    <link rel="stylesheet" href="css/index/style2.css">
    <!-- FontAwesome CSS Link -->
    <link rel="stylesheet" href="css/index/style.css">
    <!-- Bootstrap CSS Link-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="shortcut icon" href="Images/Icon.png" />
</head>
<style>

</style>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-md py-5">
            <a class="navbar-brand" href="#">
                <h4>BURGERBYTE</h4>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto menu">
                    <li class="nav-item active ml-3">
                        <a class="nav-link text-white font-weight-bold" href="#">Burger</a>
                    </li>
                    <li class="nav-item ml-3">
                        <a class="nav-link text-white font-weight-bold" href="#">Crispy</a>
                    </li>
                    <li class="nav-item ml-3">
                        <a class="nav-link text-white font-weight-bold" href="#">Oblong</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto top-links">
                    <li class="nav-item mr-3 font-weight-lighter">
                        <a class="nav-link text-white" href="#"><i class="fas fa-search"></i></a>
                    </li>
                    <li class="nav-item mr-3 font-weight-lighter">
                        <a class="nav-link text-white" href="Adminstrator/Login_Owner.php"><i
                                class="far fa-user"></i></a>
                    </li>
                    <li class="nav-item font-weight-lighter">
                        <a class="nav-link text-white" href="#"><i class="fas fa-calendar"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 text-center mx-auto carousel-section">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="item">
                                    <h1 class="text-center text-white font-weight-bold img">Burger</h1>
                                    <img src="images/Index/carousel1.png" class="d-block w-75 img1" alt="burger">
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="item">
                                    <h1 class="text-center text-white font-weight-bold img">Crispy</h1>
                                    <img src="images/Index/carousel2.png" class="d-block img2" alt="burger">
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="item">
                                    <h1 class="text-center text-white font-weight-bold img">Oblong</h1>
                                    <img src="images/Index/carousel3.png" class="d-block img3" alt="burger">
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container maintext d-flex">
            <div class="row d-flex align-items-end w-100">
                <div class="col-lg-9 col-md-6 col-sm-12 social">
                    <div class="social-icons">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fab fa-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 ml-auto p-0">
                    <div class="text text-right">
                        <h3 class="text-uppercase">OUR CLASSIC FOOD</h3>
                        <p class="mt-4">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ex eaque, in eveniet
                            recusandae nesciunt minima exercitationem!
                        </p>
                        <p>Share<i class="fas fa-share-alt"></i></p>
                        <p><span>EN |</span> SP | FR</p>
                    </div>
                </div>
            </div>
        </div>
        <!--JQuery, Popper Js, Bootstrap 4 Js -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <!--Fontawesome js link -->
        <script src="css/index/all.js"></script>
</body>

</html>