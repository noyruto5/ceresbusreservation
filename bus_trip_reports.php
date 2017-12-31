<?php
    include "php_library/SiteBasics.php";
    include "php_library/BusReports.php";
    $site_basics = new SiteBasics;
    $site_basics->authenticate();
    $bus_reports = new BusReports;

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
                    <h2>Bus Trip Reports</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="bus_trip_reports.php">Reports</a>
                        </li>
                        <li class="active">
                            <strong>Bus Trip Reports</strong>
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
                        <h5>Reports of all bus travelled</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                        </div>
                    </div>
                    <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="table-bus-report">
                    <thead>
                    <tr>
                        <th>Bus No.</th>
                        <th>Date Departure</th>
                        <th>Time Departure</th>
                        <th>Distination</th>
                        <th>Full Loaded</th>
                        <th>Passengers</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    <?php $bus_reports->read(); ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Bus No.</th>
                        <th>Date Departure</th>
                        <th>Time Departure</th>
                        <th>Distination</th>
                        <th>Full Loaded</th>
                        <th>Passengers</th>
                    </tr>
                    </tfoot>
                    </table>
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

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $("#table-bus-report").dataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
</body>
</html>