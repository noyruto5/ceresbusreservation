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

    <title><?php $site_basics->site_title("Contacts"); ?></title>

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
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item active">
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
      <h1 class="mt-4 mb-3">Contact
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Contact</li>
      </ol>

      <!-- Content Row -->
      <div class="row">
        <!-- Map Column -->
        <div class="col-lg-8 mb-4">
           <div id="googleMap" style="width:100%;height:400px;"></div>
        </div>

        <!-- Contact Details Column -->
        <div class="col-lg-4 mb-4">
          <h3>Contact Details</h3>
          <p>
            Poblacion 2,
            <br>Sagay City, Negros Occ., 6122
            <br>
          </p>
          <p>
            <i class="fa fa-phone"></i>&nbsp;&nbsp;(034) 441-0066 / (034) 432-3099
          </p>
          <p>
            <i class="fa fa-mobile"></i>&nbsp;&nbsp;&nbsp;&nbsp;09178902327
          </p>
          <p>
            <i class="fa fa-envelope"></i>&nbsp;&nbsp;name@example.com
          </p>
          <p>
            <i class="fa fa-home"></i>&nbsp;&nbsp;Monday - Friday: 9:00 AM to 5:00 PM
          </p>
        </div>
      </div>
      <!-- /.row -->
    </div>
    
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
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>
    
    <script>
    function initMap() {
        var sgy_terminal = {lat: 10.892622, lng: 123.410932};
        var map = new google.maps.Map(document.getElementById('googleMap'), {
          zoom: 18,
          center: sgy_terminal
        });
        var marker = new google.maps.Marker({
          position: sgy_terminal,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTFzUcHwnN0uZ0QU53Avf5mdRldIrBjos&callback=initMap">
    </script>
  </body>

</html>