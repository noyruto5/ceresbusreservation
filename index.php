<?php
    include "php_library/SiteBasics.php";
    $site_basics = new SiteBasics;
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php $site_basics->site_title("Home"); ?></title>

    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="landingpage_assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="landingpage_assets/css/modern-business.css" rel="stylesheet">

  </head>

  <body style="width: 80%; margin: auto;">

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Cere Bus Travel Reservation</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contacts.php">Contact</a>
            </li> 
            <?php if (isset($_COOKIE['USERNAME']) && isset($_COOKIE['PASSWORD'])) { ?>
            <li class="nav-item">
              <a class="nav-link" href="reservation_form.php">Reservation</a>
            </li>
            <?php } ?>
             <?php if (isset($_COOKIE['USERNAME']) && isset($_COOKIE['PASSWORD'])) { ?>
            <li class="nav-item" style="margin-left: 50px;">
              <a class="nav-link" href="logout.php"><i class="fa fa-sign-out"></i> Log out</a>
            </li>
            <?php } else { ?>
            <li class="nav-item" style="margin-left: 50px;">
              <a class="nav-link" href="register.php"><i class="fa fa-user"></i> Sign Up</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php"><i class="fa fa-sign-in"></i> Log in</a>
            </li>
            <?php } ?>      
          </ul>
        </div>
      </div>
    </nav>

    <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox" style="height: 300px;">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('landingpage_assets/images/bus-terminal.jpg');">
            <div class="carousel-caption d-none d-md-block">
              <h3>First Slide</h3>
              <p>This is a description for the first slide.</p>
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('landingpage_assets/images/bus-terminal2.jpg');">
            <div class="carousel-caption d-none d-md-block">
              <h3>Second Slide</h3>
              <p>This is a description for the second slide.</p>
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('landingpage_assets/images/webr1.png');">
            <div class="carousel-caption d-none d-md-block">
              <h3>Third Slide</h3>
              <p>This is a description for the third slide.</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <!-- Page Content -->
    <div class="container">
      <br/>
      <h2>Bus Fares</h2>
      <br/>
      <!-- Pricing Row -->
      <div class="row">
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h3 class="card-header">Trip A</h3>
            <div class="card-body">
              <div class="display-4">&#x20B1; 500.00</div>
              <div class="font-italic">per trip</div>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Sagay-Cebu Via Tolido/Tabuelan</li>
              <li class="list-group-item">45 seats</li>
              <li class="list-group-item">Air Conditioned</li>
              <li class="list-group-item">

                <?php if (isset($_COOKIE['USERNAME']) && isset($_COOKIE['PASSWORD'])) { ?>
                  <a href="reservation_form.php" class="btn btn-primary">Book Now!</a>
                <?php } else { ?>
                  <a href="login.php" class="btn btn-primary">Book Now!</a>
                <?php } ?>

              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card card-outline-primary h-100">
            <h3 class="card-header">Trip B</h3>
            <div class="card-body">
              <div class="display-4">&#x20B1; 465.00</div>
              <div class="font-italic">per trip</div>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Sagay-Cebu Via Tolido/Tabuelan</li>
              <li class="list-group-item">45 seats</li>
              <li class="list-group-item">Economy</li>
              <li class="list-group-item">
              
                <?php if (isset($_COOKIE['USERNAME']) && isset($_COOKIE['PASSWORD'])) { ?>
                  <a href="reservation_form.php" class="btn btn-primary">Book Now!</a>
                <?php } else { ?>
                  <a href="login.php" class="btn btn-primary">Book Now!</a>
                <?php } ?>

              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h3 class="card-header bg-primary">Trip C</h3>
            <div class="card-body">
              <div class="display-4">&#x20B1; 1,200.00</div>
              <div class="font-italic">per trip</div>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Sagay-Zamboanga</li>
              <li class="list-group-item">45 seats</li>
              <li class="list-group-item">Air Conditioned / Free Wifi</li>
              <li class="list-group-item">
                
                <?php if (isset($_COOKIE['USERNAME']) && isset($_COOKIE['PASSWORD'])) { ?>
                  <a href="reservation_form.php" class="btn btn-primary">Book Now!</a>
                <?php } else { ?>
                  <a href="login.php" class="btn btn-primary">Book Now!</a>
                <?php } ?>
                
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <br/>
     

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Ceres Bus Travel Reservation 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="landingpage_assets/vendor/jquery/jquery.min.js"></script>
    <script src="landingpage_assets/vendor/popper/popper.min.js"></script>
    <script src="landingpage_assets/vendor/bootstrap/js/bootstrap.min.js"></script>

  </body>

</html>
