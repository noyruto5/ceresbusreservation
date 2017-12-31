<?php
    include "php_library/SiteBasics.php";
    include "php_library/Reservation.php";
    $site_basics = new SiteBasics; 
    $site_basics->authenticate(); 

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
                    <h2>Reservation Form</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li class="active">
                            <strong>Reservation Form</strong>
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
                        <div class="ibox-title">
                            <h5>Booking and Reservation Form</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <p>
                                Please fill up the form completely to proceed to the next stage.
                            </p>
                            <br/>
                            <form action="finish_reservation.php" method="POST">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>Date Departure: </label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="date" id="date_departure" name="date_departure" class="form-control" required value="<?php echo $reservation->get_date_departure(); ?>" >
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>Time Departure: </label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control m-b" required id="time_departure" name="time_departure">   
                                        <option>6:30 AM - 10:30 AM</option>
                                        <option>10:00 AM - 2:00 PM</option>
                                        <option>12:00 PM - 4:00 PM</option>
                                        <option>8:00 PM - 12:00 AM</option>
                                        <option>11:00 PM - 3:00 AM</option>
                                        <option>1:00 AM - 5:00 AM</option>
                                        <option>8:00 AM - 8:00 PM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>Distination: </label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control m-b" id="route" name="route" required>
                                        <option>Sagay-Cebu Via Tolido</option>
                                        <option>Sagay-Cebu Via Tabuelan</option>
                                        <option>Sagay-Zamboanga</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>Seat No.:&nbsp;&nbsp;</label>
                                </div>
                                <div class="col-sm-6">
                                    <span id="label_seat_no">0</span><br/><br/>
                                    <button data-toggle="modal" data-target="#myModalSmall" type="button" id="available-seat-btn">Available Seats</button>
                                    <input id="seat_no" name="seat_no" type="hidden" class="form-control" required>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>Payment option: </label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control m-b" required id="payment-option" name="payment">
                                        <option></option>
                                        <option>Paypal</option>
                                        <option>Ceres Terminal</option>
                                    </select>
                                </div>
                            </div>
                            <br/>
                            <div class="row" style="margin-left: 5px;">
                                <div class="checkbox i-checks"><input id="acceptTerms" name="acceptTerms" type="checkbox" checked="" class="required"><label for="acceptTerms">I agree with the Terms and Conditions. <a href="#">Read</a></label>
                                </div>
                            </div>
                            <br/>
                            <button type="submit" class="btn btn-success">Submit</button>
                            </form>
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

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Jquery Validate -->
    <script src="js/plugins/validate/jquery.validate.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>

    <!-- my javascripts -->
    <script src="js/bus_seats.js"></script>
    <script src="js/handy_script.js"></script>
   
    <script>
        $(document).ready(function(){

            $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });            
       });
    </script>

</body>

</html>
