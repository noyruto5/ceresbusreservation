<?php
class ReservationReports extends SiteBasics {

	function daily_res_chart() {
		if (isset($_POST['month']) && isset($_POST['year'])) {
		$month = $_POST['month'];
		$year = $_POST['year'];

		$this->connect();

			echo "<script type='text/javascript'>
					// Daily chart
		            var barData = {
		                labels: ['D1', 'D2', 'D3', 'D4', 'D5', 'D6', 'D7', 'D8', 'D9', 'D10', 'D11', 'D12', 'D13', 'D14', 'D15', 'D16', 'D17', 'D18', 'D19', 'D20', 'D21', 'D22', 'D23', 'D24', 'D25', 'D26', 'D27', 'D28', 'D29', 'D30', 'D31'],
		                datasets: [
		                    {
		                        label: 'My Second dataset',
		                        fillColor: 'rgba(26,179,148,0.5)',
		                        strokeColor: 'rgba(26,179,148,0.8)',
		                        highlightFill: 'rgba(26,179,148,0.75)',
		                        highlightStroke: 'rgba(26,179,148,1)',
		                        data: [";

		                        for ($day = 1; $day <= 31; $day++) {
		                        	($day < 10) ? $day = '0'.$day : $day; // add 0 number to num 1-9 to make it 2 digits
									$result = $this->conn->query("SELECT COUNT(id) AS total FROM reservation 
																WHERE DATE_FORMAT(date_departure, '%M %d %Y') = '".$month. " " . $day . " " . $year ."' 
																AND status = 'confirmed' ") or die("Error: ".$this->conn->error);

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
		                scaleGridLineColor: 'rgba(0,0,0,.05)',
		                scaleGridLineWidth: 1,
		                barShowStroke: true,
		                barStrokeWidth: 2,
		                barValueSpacing: 5,
		                barDatasetSpacing: 1,
		                responsive: true,
		            }

		            var ctx = document.getElementById('dailyChart').getContext('2d');
		            var dailyChart = new Chart(ctx).Bar(barData, barOptions);

			</script>";

			$this->conn->close();
		}
	}


	function monthly_res_chart() {
		if (isset($_POST['year'])) {
		$year = $_POST['year'];

		$this->connect();

			echo "<script type='text/javascript'>
					
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
	                            $result = $this->conn->query("SELECT COUNT(id) AS total FROM reservation 
	                                                        WHERE EXTRACT(MONTH FROM date_departure) = '".$month."' 
	                                                        AND EXTRACT(YEAR FROM date_departure) = '".$year."'
	                                                        AND status = 'confirmed' ") or die("Error: ".$this->conn()->error);

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
			</script>";

			$this->conn->close();
		}
	}


	function yearly_res_chart() {
		if ( isset($_POST['year_frm']) && isset($_POST['year_to']) ) {
		$year_frm = $_POST['year_frm'];
		$year_to = $_POST['year_to'];

		$this->connect();

			echo "<script type='text/javascript'>
					
				// Yearly chart
	            var radarData = {
	                labels: [";
	                for (;$year_frm <= $year_to; $year_frm++) {
	                    echo "'".$year_frm."',";
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

	                        $year_frm = $_POST['year_frm'];
							$year_to = $_POST['year_to'];
	                        for (;$year_frm <= $year_to; $year_frm++) {
	                            $result = $this->conn->query("SELECT COUNT(id) AS total FROM reservation 
	                                                        WHERE EXTRACT(YEAR FROM date_departure) = '".$year_frm."'
	                                                        AND status = 'confirmed' ") or die("Error: ".$this->conn->error);

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

			$this->conn->close();
		}
	}
}
?>