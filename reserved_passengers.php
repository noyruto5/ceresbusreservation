<?php
    include "php_library/SiteBasics.php";
    include "php_library/Reservation.php";
    $site_basics = new SiteBasics;
    $site_basics->authenticate();
    $reservation = new Reservation;

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
                    <h2>Reserved Passengers</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="reserved_passengers.php">Reservation</a>
                        </li>
                        <li class="active">
                            <strong>Reserved Passengers</strong>
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
                        <h5>Passengers Lists</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                        </div>
                    </div>
                    <div class="ibox-content">

                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <table class="table table-striped table-bordered table-hover" id="table-reservation">
                    <thead>
                    <tr>
                        <th>Ref. No.</th>
                        <th>Name</th>
                        <th>Travel Schedule</th>
                        <th>Distination</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    <?php $reservation->read(); ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Ref. No.</th>
                        <th>Name</th>
                        <th>Travel Schedule</th>
                        <th>Distination</th>
                        <th>Status</th>
                    </tr>
                    </tfoot>
                    </table>
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
    <script src="js/plugins/jeditable/jquery.jeditable.js"></script>

    <!-- Data Tables -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.16/b-1.4.2/b-html5-1.4.2/b-print-1.4.2/datatables.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>

    <!-- myscript -->
    <script src="js/reservation.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $("#table-reservation").dataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
</body>
</html>
