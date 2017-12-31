<?php include "php_library/SiteBasics.php"; ?>
<?php $site_basics = new SiteBasics; ?>
<?php $site_basics->authenticate(); ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php $site_basics->site_title("Dashboard"); ?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/mystyle.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <img alt="image" class="img-circle" src="img/site-logo-small.png"/>
                             </span>
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold" style="color:white;">Web-base Booking and Reservation</strong><br/>
                    </li>
                    <li class="active">
                        <a href="index.php"><i class="fa fa-home"></i> <span class="nav-label">Home</span> </a>
                    </li>
                    <li>
                        <a href="bus_details.php"><i class="fa fa-bus"></i> <span class="nav-label">Bus Details</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-book"></i> <span class="nav-label">Book and Reservation</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="reservation_form.php">Reservation Form</a></li>
                            <li><a href="reserved_passengers.php">Reserved Passengers</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="contacts.php"><i class="fa fa-phone"></i> <span class="nav-label">Contacts</span>
                    </li>
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to Web-based Booking and Reservation System.</span>&nbsp;&nbsp;
                </li>
                <li>
                    <a href="logout.php">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>
                
                <div class="wrapper wrapper-content animated fadeInRight">
            
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            
                            <div class="ibox-content" style="min-height: 500px;">
                                
                            </div>
                        </div>
                        </div>

                    </div>
                </div>
                <div class="footer">
                    <div class="pull-right">
                        10GB of <strong>250GB</strong> Free.
                    </div>
                    <div>
                        <strong>Copyright</strong> Example Company &copy; 2014-2015
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>


    <script>
        $(document).ready(function() {
            
        });
    </script>
</body>
</html>
