<?php
    include "php_library/SiteBasics.php";
    include "php_library/ReservationReports.php";
    $site_basics = new SiteBasics;
    $site_basics->authenticate();
    $res_reports = new ReservationReports;

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
                    <h2>Reservation Reports</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="reservation_reports.php">Reports</a>
                        </li>
                        <li class="active">
                            <strong>Reservation Reports</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        
        <!-- content here -->
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Daily Reserved Passengers</h5>
                            <div ibox-tools></div>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="dailyChart" height="80"></canvas>
                            </div>
                            <div id="daily-script-holder">
                            </div>
                            <br/>
                            <div id="daily">
                                <select class="month">
                                    <option>Month</option>
                                    <option>January</option>
                                    <option>February</option>
                                    <option>March</option>
                                    <option>April</option>
                                    <option>May</option>
                                    <option>June</option>
                                    <option>July</option>
                                    <option>August</option>
                                    <option>September</option>
                                    <option>October</option>
                                    <option>November</option>
                                    <option>December</option>
                                </select>&nbsp;
                                <select class="year">
                                    <option>Year</option>
                                    <script type="text/javascript">
                                        var yr_strt = 2018;
                                        for (i = 10; i <= 20; i++) {
                                            yr_strt-=1;
                                            document.write('<option>'+ yr_strt +'</option>');
                                        }
                                    </script>
                                </select>&nbsp;
                                <button type="button" class="btn-show">Show</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Monthly Reserved Passengers</h5>
                            <div ibox-tools></div>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="monthlyChart" height="140"></canvas>
                            </div>
                            <div id="monthly-script-holder">
                            </div>
                            <br/>
                            <div id="monthly">
                                <select class="year">
                                    <option>Year</option>
                                    <script type="text/javascript">
                                        var yr_strt = 2018;
                                        for (i = 10; i <= 20; i++) {
                                            yr_strt-=1;
                                            document.write('<option>'+ yr_strt +'</option>');
                                        }
                                    </script>
                                </select>&nbsp;
                                <button type="button" class="btn-show">Show</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Yearly Reserved Passengers</h5>
                            <div ibox-tools></div>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="yearlyChart" height="140"></canvas>
                            </div>
                            <div id="yearly-script-holder">
                            </div>
                            <br/>
                            <div id="yearly">
                                <select id="year-from">
                                    <option>From Year</option>
                                    <script type="text/javascript">
                                        var yr_strt = 2018;
                                        for (i = 10; i <= 20; i++) {
                                            yr_strt-=1;
                                            document.write('<option>'+ yr_strt +'</option>');
                                        }
                                    </script>
                                </select>&nbsp;
                                <!-- should put a range limit -->
                                <select id="year-to">
                                    <option>To Year</option>
                                    <script type="text/javascript">
                                        var yr_strt = 2018;
                                        for (i = 10; i <= 20; i++) {
                                            yr_strt-=1;
                                            document.write('<option>'+ yr_strt +'</option>');
                                        }
                                    </script>
                                </select>&nbsp;
                                <button type="button" class="btn-show">Show</button>
                            </div>
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

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>

    <?php $site_basics->connect(); ?>
    <?php

    // These are the default data explicitly set
     echo "<script>
            
            // Daily chart
            var barData = {
                labels: [\"D1\", \"D2\", \"D3\", \"D4\", \"D5\", \"D6\", \"D7\", \"D8\", \"D9\", \"D10\", \"D11\", \"D12\", \"D13\", \"D14\", \"D15\", \"D16\", \"D17\", \"D18\", \"D19\", \"D20\", \"D21\", \"D22\", \"D23\", \"D24\", \"D25\", \"D26\", \"D27\", \"D28\", \"D29\", \"D30\", \"D31\"],
                datasets: [
                    {
                        label: \"My Second dataset\",
                        fillColor: \"rgba(26,179,148,0.5)\",
                        strokeColor: \"rgba(26,179,148,0.8)\",
                        highlightFill: \"rgba(26,179,148,0.75)\",
                        highlightStroke: \"rgba(26,179,148,1)\",
                        data: [";

                        for ($day = 1; $day <= 31; $day++) {
                            ($day < 10) ? $day = '0'.$day : $day; // add 0 number to num 1-9 to make it 2 digits
                            $result = $site_basics->get_conn()->query("SELECT COUNT(id) AS total FROM reservation 
                                                        WHERE DATE_FORMAT(date_departure, '%M %d %Y') = 'October " . $day . " 2017' 
                                                        AND status = 'confirmed' ") or die("Error: ".$site_basics->get_conn()->error);

                            $row = $result->fetch_assoc();
                            echo $row['total'] . ",";
                        }

                        echo "]
                    }
                ]
            };

            var barOptions = {
                scaleBeginAtZero: true,
                scaleShowGridLines: true,
                scaleGridLineColor: \"rgba(0,0,0,.05)\",
                scaleGridLineWidth: 1,
                barShowStroke: true,
                barStrokeWidth: 2,
                barValueSpacing: 5,
                barDatasetSpacing: 1,
                responsive: true,
            }

            var ctx = document.getElementById(\"dailyChart\").getContext(\"2d\");
            var dailyChart = new Chart(ctx).Bar(barData, barOptions);


            // Monthly chart
            var lineData = {
                labels: [\"Jan\", \"Feb\", \"Mar\", \"Apr\", \"May\", \"Jun\", \"Jul\", \"Aug\", \"Sep\", \"Oct\", \"Nov\", \"Dec\"],
                datasets: [
                    {
                        label: \"Example dataset\",
                        fillColor: \"rgba(26,179,148,0.5)\",
                        strokeColor: \"rgba(26,179,148,0.7)\",
                        pointColor: \"rgba(26,179,148,1)\",
                        pointStrokeColor: \"#fff\",
                        pointHighlightFill: \"#fff\",
                        pointHighlightStroke: \"rgba(26,179,148,1)\",
                        data: [";

                        for ($month = 1; $month <= 12; $month++) {
                            ($month < 10) ? $month = '0'.$month : $month; // add 0 number to num 1-9 to make it 2 digits
                            $result = $site_basics->get_conn()->query("SELECT COUNT(id) AS total FROM reservation 
                                                        WHERE EXTRACT(MONTH FROM date_departure) = '".$month."' 
                                                        AND EXTRACT(YEAR FROM date_departure) = '2017'
                                                        AND status = 'confirmed' ") or die("Error: ".$site_basics->get_conn()->error);

                            $row = $result->fetch_assoc();
                            echo $row['total'] . ",";
                        }

                        echo "]
                    }
                ]
            };

            var lineOptions = {
                scaleShowGridLines: true,
                scaleGridLineColor: \"rgba(0,0,0,.05)\",
                scaleGridLineWidth: 1,
                bezierCurve: true,
                bezierCurveTension: 0.4,
                pointDot: true,
                pointDotRadius: 4,
                pointDotStrokeWidth: 1,
                pointHitDetectionRadius: 20,
                datasetStroke: true,
                datasetStrokeWidth: 2,
                datasetFill: true,
                responsive: true,
            };

            var ctx = document.getElementById(\"monthlyChart\").getContext(\"2d\");
            var monthlyChart = new Chart(ctx).Line(lineData, lineOptions);


            // Yearly chart
            var radarData = {
                labels: [";
                $year_from = 2013;
                $year_to = 2017;
                for (;$year_from <= $year_to; $year_from++) {
                    echo "'".$year_from."',";
                }
                echo "],
                datasets: [
                    {
                        label: \"My Second dataset\",
                        fillColor: \"rgba(26,179,148,0.2)\",
                        strokeColor: \"rgba(26,179,148,1)\",
                        pointColor: \"rgba(26,179,148,1)\",
                        pointStrokeColor: \"#fff\",
                        pointHighlightFill: \"#fff\",
                        pointHighlightStroke: \"rgba(151,187,205,1)\",
                        data: [";
                        $year_from = 2013;
                        $year_to = 2017;
                        for (;$year_from <= $year_to; $year_from++) {
                            $result = $site_basics->get_conn()->query("SELECT COUNT(id) AS total FROM reservation 
                                                        WHERE EXTRACT(YEAR FROM date_departure) = '".$year_from."'
                                                        AND status = 'confirmed' ") or die("Error: ".$site_basics->get_conn()->error);

                            $row = $result->fetch_assoc();
                            echo $row['total'] . ",";
                        }
                        echo "]
                    }
                ]
            };

            var radarOptions = {
                scaleShowLine: true,
                angleShowLineOut: true,
                scaleShowLabels: false,
                scaleBeginAtZero: true,
                angleLineColor: \"rgba(0,0,0,.1)\",
                angleLineWidth: 1,
                pointLabelFontFamily: \"'Arial'\",
                pointLabelFontStyle: \"normal\",
                pointLabelFontSize: 10,
                pointLabelFontColor: \"#666\",
                pointDot: true,
                pointDotRadius: 3,
                pointDotStrokeWidth: 1,
                pointHitDetectionRadius: 20,
                datasetStroke: true,
                datasetStrokeWidth: 2,
                datasetFill: true,
                responsive: true,
            }

            var ctx = document.getElementById(\"yearlyChart\").getContext(\"2d\");
            var yearlyChart = new Chart(ctx).Radar(radarData, radarOptions);

    </script>";
    ?>
    <script src="js/reservation_reports.js"></script>
</body>
</html>