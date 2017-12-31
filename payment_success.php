<?php
    include "php_library/SiteBasics.php";
    include "php_library/Reservation.php";
    $site_basics = new SiteBasics; 
    $site_basics->authenticate(); 
    $reservation = new Reservation;

    //get the basename
    $basename = basename(__FILE__);
?>

<?php include "header.php"; ?>

<body>

    <div id="wrapper">

        <?php include "nav.php"; ?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Reservation Complete</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="reservation_form.php">Reservation Form</a>
                        </li>
                        <li class="active">
                            <strong>Reservation Complete</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        
                        <div class="ibox-content" style="min-height: 500px; font-size: 1.1em; background-color: #FFFFCC;">
                            <?php $reservation->payment_success(); ?>
                                
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        
        <?php include "footer.php"; ?>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Jquery Validate -->
    <script src="js/plugins/validate/jquery.validate.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>

</body>

</html>
