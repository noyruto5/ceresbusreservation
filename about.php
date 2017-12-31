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

  <body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Cere Bus Travel Reservation</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item active">
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

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">About
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">About</li>
      </ol>

      <!-- Intro Content -->
      <div class="row">
        <div class="col-lg-6">
          <img class="img-fluid rounded mb-4" src="landingpage_assets/images/bus-terminal.jpg" alt="">
        </div>
        <div class="col-lg-6">
          <h2>About Our Company</h2>
          <p>As cited in  Vallacar Transit Incorporated company was discovered in 1968 by Ricardo B. Yanson, he passed away on Sunday October 25, 2015 and his wife, Olivia Villa Flores Yanson.</p>
          <p>starting to purchase one jeepney business unit and they start up a jeepney business, In 1970 they heard the advertisement about ford fieras, and they decided to have a start-up business like into a small bus line which trip to Bacolod City, Valladolid la Carlota route.</p>
          <p>They named of Ceres lines was came from their youngest sister named Christened, then the Vallacar Transit Incorporated started in 1968 this is the first business of the Yanson family of bus companies and in 1980 the Ceres liner was covered the whole province of Negros and in 2007.</p>
        </div>
      </div>
      <!-- /.row -->

      

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