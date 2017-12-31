<?php
    include "php_library/SiteBasics.php";
    include "php_library/Reservation.php";
    $site_basics = new SiteBasics;
    $site_basics->authenticate();
    
    if ($site_basics->get_role() == 'guest') {
        header("Location: 404.html");
    }

    //get the basename
    $basename = basename(__FILE__);
    setcookie('BASENAME', $basename);

    $reservation = new Reservation;
?>

<?php include "header.php"; ?>

<body>
    <div id="wrapper">
        
        <?php include "nav.php"; ?>

        <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Passenger's Record</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="reserved_passengers.php">Reservation</a>
                        </li>
                        <li class="active">
                            <strong>Passenger's Record</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

        
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Reserve passenger's record</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                        </div>
                    </div>
                    <div class="ibox-content res-pass-content">
                        <?php $reservation->passengers_record(); ?>
                        
                        <!-- modal --> 
                                            <div class="modal inmodal fade" id="myModalSmall" tabindex="-1" role="dialog"  aria-hidden="true">
                                                <div class="modal-dialog modal-sm" style="width: 450px;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                            <h4 class="modal-title">Choose Seat No.</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- dynamically loaded table will appear here -->
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-white" data-dismiss="modal" id="btn-cancel">Cancel</button>
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of modal -->
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
    <script src="js/plugins/jeditable/jquery.jeditable.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- myscript -->
    <script src="js/reservation.js"></script>
    <script src="js/bus_seats.js"></script>
    <script src="js/handy_script.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {

        });
    </script>

</body>
</html>