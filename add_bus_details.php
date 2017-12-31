<?php
    include "php_library/SiteBasics.php";
    include "php_library/BusDetails.php";
    $site_basics = new SiteBasics; 
    $site_basics->authenticate(); 

    $bus_details = new BusDetails;

    if ($site_basics->get_role() == 'guest') {
        header("Location: 404.html");
    }

    //get the basename
    $basename = basename(__FILE__);
?>
<?php include "header.php"; ?>

<body>

    <div id="wrapper">

        <?php include "nav.php"; ?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Add New Bus Details</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="bus_details.php">Bus Details</a>
                        </li>
                        <li class="active">
                            <strong>Add New Bus Details</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

            <?php $bus_details->create(); ?>
            <?php if ( isset($bus_details->input_warning) ) { ?>
                <div class="alert alert-danger">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?php echo $bus_details->input_warning; ?>
                </div>
            <?php } else if ( isset($bus_details->input_success) ) { ?>
                <div class="alert alert-success">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?php echo $bus_details->input_success; ?>
                </div>
            <?php } ?>

        <div class="wrapper wrapper-content animated fadeInRight">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add new record form</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal">
                                <div class="form-group"><label class="col-sm-2 control-label">Distination</label>

                                    <div class="col-sm-5"><select class="form-control m-b" name="route" id="add_bus_detail_route" required="">
                                        <option></option>
                                        <option>Sagay-Cebu Via Tolido</option>
                                        <option>Sagay-Cebu Via Tabuelan</option>
                                        <option>Sagay-Zamboanga</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Bus No.</label>

                                    <div class="col-sm-5"><select class="form-control m-b" name="bus_no" id="add_bus_detail_bus_no" required="">
                                        <option></option>
                                        <option>532</option>
                                        <option>535</option>
                                        <option>537</option>
                                        <option>517</option>
                                        <option>55001</option>
                                        <option>555</option>
                                        <option>5775</option>
                                        <option>5776</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Date Departure</label>
                                    <div class="col-sm-5"><input type="date" name="date_departure" required="" class="form-control"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Time Departure</label>

                                    <div class="col-sm-5"><select class="form-control m-b" name="time_departure" id="add_bus_details_time_dep" required="">   
                                        <option></option>
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
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Class</label>
                                    <div class="col-sm-5"><select class="form-control m-b" name="class" required="">   
                                        <option></option>
                                        <option>Air Conditioned</option>
                                        <option>Economy</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="bus_details.php" class="btn btn-white" type="button">Cancel</a><span>&nbsp;</span>
                                        <button class="btn btn-primary" type="submit" name="save">Save changes</button>
                                    </div>
                                </div>
                            </form>
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

    <!-- My own scripts -->
    <script src="js/handy_script.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
</body>

</html>
