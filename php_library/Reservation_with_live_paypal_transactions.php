<?php
class Reservation extends SiteBasics{
	protected $date_departure;

	function get_date_departure() {

		$this->connect();

		$result = $this->conn->query("SELECT date_departure FROM bus_details 
									WHERE full_load = 'no'
									ORDER BY date_departure ASC") or die("Error: ".$this->conn->error);

		$row = $result->fetch_assoc();
		$this->date_departure = $row['date_departure'];
		return $this->date_departure;
	}

	/*
	* @var must only be "time_departure" or "route" value
	*/
	function get_route_time_departure($var) {
		$this->get_date_departure();

		$result = $this->conn->query("SELECT DISTINCT($var) FROM bus_details 
									WHERE full_load = 'no' AND date_departure = '".$this->date_departure."'
									") or die("Error: ".$this->conn->error);

		while($row = $result->fetch_assoc()) {
			echo "<option>".$row[$var]."</option>";
		}
		$this->conn->close();
	}


	function read() {
		$this->connect();

		$result = $this->conn->query("SELECT reservation.*, users.*, reservation.id AS r_id, reservation.status AS r_status FROM reservation INNER JOIN users ON reservation.username = users.username ORDER BY date_departure ASC");

		
		while($row = $result->fetch_assoc())
		{
			echo "<tr data-href='res_passengers_record.php?id=".$row['r_id']."'>
					<td>".$row['ref_no']."</td>
					<td>".$row['fname']. "&nbsp;&nbsp;" .  $row['lname'] ."</td>
					<td>".$row['date_departure']. "&nbsp;&nbsp;". $row['time_departure'] ."</td>
					<td>".$row['route']."</td>";

					if ($row['r_status'] === 'confirmed') {
						echo "<td>".$row['r_status']."</td>";
					} else {
						echo "<td><button type='submit' title='Click to confirm' class='btn-confirm' value='".$row['r_id']."'>".$row['r_status']."</button>
							</td>";
					}

			echo "</tr>";
		}
		$this->conn->close();
	}


	function create() {

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
		{

			$this->connect();

			$username = $_COOKIE['USERNAME'];
			$date_departure = $this->input_validation($_POST['date_departure']);						
			$time_departure = $this->input_validation($_POST['time_departure']);	
			$payment = $this->input_validation($_POST['payment']);		
			$route = $this->input_validation($_POST['route']);	
			$seat_no = $this->input_validation($_POST['seat_no']);

			//check if filled up completely
			if ( isset($date_departure) && $date_departure != ""
				&& isset($time_departure) && $time_departure != "" && isset($route) && $route != ""
				&& isset($seat_no) && $seat_no != "" && isset($payment) && $payment != "" )
			{
				$ref_no = "WEBR" . time() . rand(10*45, 100*98);
				$status = "pending";
				// declare $bus_no and $bd_id variable to make it local
				$bus_no;
				$bd_id;

				//for getting id and bus no.
				$res = $this->conn->query("SELECT id, bus_no FROM bus_details
												WHERE date_departure = '".$date_departure."'
												AND time_departure = '".$time_departure."'
												AND route = '".$route."'
												") or die("Error: ".$this->conn->error);

				if ($res->num_rows > 0) {
					$row = $res->fetch_assoc();
					// $bd_id is foreign key to bus_details id
					$bd_id = $row['id'];
					$bus_no = $row['bus_no'];
				}
				else {
					echo "No result of bus details.";
				}

				//check if bus seat already occupied
				$result1 = $this->conn->query("SELECT * FROM reservation 
											WHERE bd_id = '".$bd_id."' AND seat_no = '".$seat_no."'
											AND date_departure = '".$date_departure."'
											AND time_departure = '".$time_departure."'
											AND route = '".$route."'
											AND status = 'confirmed'") or die("Error: ".$this->conn->error);

				if ( $result1->num_rows == 0 )
				{
					//check for duplicate records. this helps if user refreshed the browser
					$result2 = $this->conn->query("SELECT * FROM reservation 
												WHERE username = '".$username."' AND date_departure = '".$date_departure."' AND time_departure = '".$time_departure."' AND bus_no = '".$bus_no."' AND seat_no = '".$seat_no."'
												") or die("Error: ".$this->conn->error);
					if ( $result2->num_rows == 0 )
					{
						$sql = "INSERT INTO reservation (bd_id, username, date_departure, time_departure, route, seat_no, bus_no, payment, ref_no, status)
								VALUES ('$bd_id', '$username', '$date_departure', '$time_departure', '$route', '$seat_no', '$bus_no', '$payment', '$ref_no', '$status')";
						 
						if ($this->conn->query($sql) === TRUE)
						{
							$id = $this->conn->insert_id;
							if ($payment == "Paypal")
							{
								if ($route == "Sagay-Cebu Via Tolido")
								{
									$this->input_success = "<h1>Online Payment with Paypal</h1><br />
									<p>Please <strong>click</strong> the button below now and process the payment to confirm your reservation.
									<strong>Note: </strong>Cancelling the payment will cancel your reservation.</p><br/>
									<form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>
							        <input type='hidden' name='cmd' value='_s-xclick'>
							        <input type='hidden' name='hosted_button_id' value='M7QQV452U6DLU'>
	        						<input type='hidden' name='custom' value='".$ref_no."'>
	        						<input type='hidden' name='rm' value='2'>
							        <input type='image' src='https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
							        <img alt='' border='0' src='https://www.paypalobjects.com/en_US/i/scr/pixel.gif' width='1' height='1'>
							        </form><br/><br/><a href='reservation_cancelled.php?id=$id' class='btn btn-default'>Cancel My Reservation</a>";
								}
								else if ($route == "Sagay-Cebu Via Tabuelan")
								{
									$this->input_success = "<h1>Online Payment with Paypal</h1><br />
									<p>Please <strong>click</strong> the button below now and process the payment to confirm your reservation.
									<strong>Note: </strong>Cancelling the payment will cancel your reservation.</p><br/>
									<form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>
							        <input type='hidden' name='cmd' value='_s-xclick'>
							        <input type='hidden' name='hosted_button_id' value='6NTVZCTMH3QMA'>
	        						<input type='hidden' name='custom' value='".$ref_no."'>
	        						<input type='hidden' name='rm' value='2'>
							        <input type='image' src='https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
							        <img alt='' border='0' src='https://www.paypalobjects.com/en_US/i/scr/pixel.gif' width='1' height='1'>
							        </form><br/><br/><a href='reservation_cancelled.php?id=$id' class='btn btn-default'>Cancel My Reservation</a>";
								}
								else //sagay-zamboanga
								{
									$this->input_success = "<h1>Online Payment with Paypal</h1><br />
									<p>Please <strong>click</strong> the button below now and process the payment to confirm your reservation.
									<strong>Note: </strong>Cancelling the payment will cancel your reservation.</p><br/>
									<form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>
							        <input type='hidden' name='cmd' value='_s-xclick'>
							        <input type='hidden' name='hosted_button_id' value='NY8VU59DNZ2XU'>
	        						<input type='hidden' name='custom' value='".$ref_no."'>
	        						<input type='hidden' name='rm' value='2'>
							        <input type='image' src='https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
							        <img alt='' border='0' src='https://www.paypalobjects.com/en_US/i/scr/pixel.gif' width='1' height='1'>
							        </form><br/><br/><a href='reservation_cancelled.php?id=$id' class='btn btn-default'>Cancel My Reservation</a>";
								}
							} 
							else
							{
								// $to = $this->user_email();
								// $subject = "Reservation reference number";
								// $msg = "Your reference no.:\n".$ref_no;
								// mail($to, $subject, $msg);
								
								$this->input_success = "<h1>Reservation saved.</h1><br />
													<p>Please copy your reference number and present it to ".$payment." and accomplish your payment to confirm you reservation.
													We also send your reference no. to your email ".$this->user_email()."
													</p><br />
													<p>Below is your reservation details.</p>
							                      <table>
							                        <tr><td><strong>Travel Schedule: </strong></td><td>".$date_departure."&nbsp;&nbsp;".$time_departure."</td></tr>
							                        <tr><td><strong>Distination: </strong></td><td>".$route."</td></tr>
							                        <tr><td><strong>Bus No.: </strong></td><td>".$bus_no."</td></tr>
							                        <tr><td><strong>Seat No.: </strong></td><td>".$seat_no."</td></tr>
							                        <tr><td><strong>Reference No.: </strong></td><td>".$ref_no."</td></tr>
							                      </table>
							                      <br/><br />
													<a href='index.php' class='btn btn-primary'>Back to home page</a>
												<br/><br/>or<br/><br/><a href='reservation_cancelled.php?id=$id' class='btn btn-default'>Cancel My Reservation</a>";
							}
						} else {
							echo "Error: " .$sql ."<br/>". $this->conn->error;
						}
					} else {
						echo $this->input_success = "Records already saved.";
					}
										
				}
				else
				{
					$this->input_warning = "*Reservation is failed. Bus seat no. {$seat_no} was occupied. Please choose another seat no.";
				}

			}
			else
			{
				$this->input_warning = "*Reservation is failed. Please complete the registration form.<br/>
										<a href='reservation_form.php' class='btn btn-default'>Back to form</a>";
			}

			$this->conn->close();
		}
		
	}


	function update() {

	}


	function delete() {
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$this->connect();
			$this->conn->query("DELETE FROM reservation WHERE id = '".$id."' ")
								or die("Error: ". $this->conn->error);
			$this->conn->close();

			return TRUE;
		}
	}


	function available_seats() {

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
		{
			$this->connect();

			$date_departure = $_POST['date_departure'];
			$time_departure = $_POST['time_departure'];
			$route = $_POST['route'];
			$bus_no;
			$array_seats = array();

			//for getting bus no.
			$result_no = $this->conn->query("SELECT bus_no, class FROM bus_details
											WHERE date_departure = '".$date_departure."'
											AND time_departure = '".$time_departure."'
											AND route = '".$route."' ") or die("Error: ".$this->conn->error);

			if ($result_no->num_rows > 0)
			{
				$row = $result_no->fetch_assoc();
				$bus_no = $row['bus_no'];
				$class = $row['class'];

				//for getting how many seats are occupied
				$result = $this->conn->query("SELECT seat_no FROM reservation 
												WHERE date_departure = '".$date_departure."'
												AND time_departure = '".$time_departure."'
												AND route = '".$route."' AND status = 'confirmed' ") or die("Error: ".$this->conn->error);

				while($rows = $result->fetch_assoc())
				{
					$array_seats[] = $rows['seat_no'];
				}
				
				echo "<center>
						<img src='img/legend-red.png' alt='red'>&nbsp;Occupied&nbsp;&nbsp;&nbsp;
						<img src='img/legend-blue.png' alt='red'>&nbsp;Available
						<table cellspacing='0' id='bus-seats-tbl' class='tbl-bus-seats'>
						<tr><th colspan='6' style='text-align:center;'>".$class." | Bus No. ".$bus_no."</th></tr>
						<tr><th colspan='6' align='left'>Driver Seat</th></tr>";

				$cell = 0;
				echo "<tr>
						<td "; echo in_array(1, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">1</td>
						<td "; echo in_array(2, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">2</td>
						<td "; echo in_array(3, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">3</td>
						<td rowspan='8'></td>
						<td "; echo in_array(4, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">4</td>
						<td "; echo in_array(5, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">5</td>
					  </tr>
					  <tr>
						<td "; echo in_array(6, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">6</td>
						<td "; echo in_array(7, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">7</td>
						<td "; echo in_array(8, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">8</td>
						<td "; echo in_array(9, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">9</td>
						<td "; echo in_array(10, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">10</td>
					  </tr>
					  <tr>
						<td "; echo in_array(11, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">11</td>
						<td "; echo in_array(12, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">12</td>
						<td "; echo in_array(13, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">13</td>
						<td "; echo in_array(14, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">14</td>
						<td "; echo in_array(15, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">15</td>
					  </tr>
					  
					  <tr>
						<td "; echo in_array(16, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">16</td>
						<td "; echo in_array(17, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">17</td>
						<td "; echo in_array(18, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">18</td>
						<td "; echo in_array(19, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">19</td>
						<td "; echo in_array(20, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">20</td>
					  </tr>
					  <tr>
						<td "; echo in_array(21, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">21</td>
						<td "; echo in_array(22, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">22</td>
						<td "; echo in_array(23, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">23</td>
						<td "; echo in_array(24, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">24</td>
						<td "; echo in_array(25, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">25</td>
					  </tr>
					  <tr>
						<td "; echo in_array(26, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">26</td>
						<td "; echo in_array(27, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">27</td>
						<td "; echo in_array(28, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">28</td>
						<td "; echo in_array(29, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">29</td>
						<td "; echo in_array(30, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">30</td>
					  </tr>
					  <tr>
						<td "; echo in_array(31, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">31</td>
						<td "; echo in_array(32, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">32</td>
						<td "; echo in_array(33, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">33</td>
						<td "; echo in_array(34, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">34</td>
						<td "; echo in_array(35, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">35</td>
					  </tr>
					  <tr>
						<td "; echo in_array(36, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">36</td>
						<td "; echo in_array(37, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">37</td>
						<td "; echo in_array(38, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">38</td>
						<td "; echo in_array(39, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">39</td>
						<td "; echo in_array(40, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">40</td>
					  </tr>
					  <tr>
						<td "; echo in_array(41, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">41</td>
						<td "; echo in_array(42, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">42</td>
						<td "; echo in_array(43, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">43</td>
						<td "; echo in_array(44, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">44</td>
						<td "; echo in_array(45, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">45</td>
						<td "; echo in_array(46, $array_seats) ? "class='filled'" : "class='unfilled'"; echo ">46</td>
					  </tr>"; 
				echo "</table></center>";
			}
			else
			{
				echo "No travel schedule available for that now.";
			}


			$this->conn->close();

		}

	}


	// This function was called using jquery ajax
	// because it cannot use header() function
	function confirm_reservation() {
		if (isset($_POST['passengers_id']))
		{
			$passengers_id = $_POST['passengers_id'];
			$this->connect();
			$this->conn->query("UPDATE reservation SET status = 'confirmed' WHERE id = '$passengers_id'") or die("Error: ".$this->conn->error);
			$this->conn->close();
		}
	}


	function passengers_record() {
		if ( isset($_GET['id']) ) {
			$id = $_GET['id'];
			$this->connect();

			$result = $this->conn->query("SELECT *, reservation.id AS passengers_id FROM reservation INNER JOIN users ON reservation.username = users.username WHERE reservation.id = '".$id."'") or die("Error: ".$this->conn->error);

			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				$status = $row['status'];
				echo "<table class='tbl-pass-record'>
						<tr><td><strong>Status: </strong></td><td>".ucfirst($status)."</td></tr>
						<tr><td><strong>Name: </strong></td><td> {$row['fname']}&nbsp;&nbsp;{$row['lname']}</td></tr>
						<tr><td><strong>Address: </strong></td><td> {$row['prk']},&nbsp;&nbsp;{$row['brgy']},&nbsp;&nbsp;{$row['city']},&nbsp;&nbsp;{$row['province']}</td></tr>
						<tr><td><strong>Schedule: </strong></td><td> {$row['date_departure']}&nbsp;&nbsp;{$row['time_departure']}</td></tr>
						<tr><td><strong>Distination: </strong></td><td> {$row['route']}</td></tr>
						<tr><td><strong>Bus No.: </strong></td><td> {$row['bus_no']}</td></tr>
						<tr><td><strong>Seat No.: </strong></td><td> {$row['seat_no']}&nbsp;&nbsp;&nbsp;
						<button type='button' data-toggle='modal' data-target='#myModalSmall' id='available-seat-btn'>Change</button></td></tr>
						<tr><td><strong>Reference No.: </strong></td><td> {$row['ref_no']}</td></tr>
						<tr><td><strong>Payment Type: </strong></td><td> {$row['payment']}</td></tr>
					</table>
					<form action='change_seat.php' method='POST'>
						<input type='hidden' name='passengers_id' id='passengers_id' value='{$row['passengers_id']}'>
						<input type='hidden' name='date_departure' id='date_departure' value='{$row['date_departure']}'>
						<input type='hidden' name='time_departure' id='time_departure' value='{$row['time_departure']}'>
						<input type='hidden' name='route' id='route' value='{$row['route']}'>
						<input type='hidden' id='seat_no' name='seat_no' >
						<button type='submit' class='btn btn-primary'>Save</button>
					</form>";
			}
			else {
				echo "<span>No records found.</span>";
			}
		}
	}


	function payment_success() {
		if (isset($_POST['custom']) OR isset($_GET['custom'])) {
			$ref_no = isset($_POST['custom']) ? $_POST['custom'] : $_GET['custom'];
			$this->connect();
			//update the passengers reservation status
			$this->conn->query("UPDATE reservation SET status = 'confirmed' WHERE ref_no = '".$ref_no."'") or die("Error: ".$this->conn->error);

			$to = $this->user_email();
			$subject = "Reservation reference number";
			$msg = "Your reference no.:\n".$ref_no;
			mail($to, $subject, $msg);

			//get the passengers record
			$result = $this->conn->query("SELECT * FROM reservation WHERE ref_no = '".$ref_no."'") or die("Error: ".$this->conn->error);

			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				$fname = $row['fname'];

				echo "<p>Thank you <strong>".ucfirst($fname)."</strong> for your payment. Your transaction has been completed, and a receipt for your purchase has been emailed to you.<br/> You may log into your account at www.paypal.com to view details of this transaction</p>
                      <br />
                      <br />
                      <p>Here's your reservation details.</p>
                      <table>
                        <tr><td><strong>Travel Schedule: </strong></td><td>".$row['date_departure']."&nbsp;&nbsp;".$row['time_departure']."</td></tr>
                        <tr><td><strong>Distination: </strong></td><td>".$row['route']."</td></tr>
                        <tr><td><strong>Bus No.: </strong></td><td>".$row['bus_no']."</td></tr>
                        <tr><td><strong>Seat No.: </strong></td><td>".$row['seat_no']."</td></tr>
                        <tr><td><strong>Reference No.: </strong></td><td>".$row['ref_no']."</td></tr>
                      </table>
                      <br />
                      <p><strong>Important Note: </strong>Present your reference number and 1 valid ID to sagay bus terminal to get your ticket.<br />Your reference number has been emailed to you ".$email.".</p>";
			}
		} else {
		echo "No value sent.";
		}
	}


	function payment_cancel() {
		if (isset($_POST['custom']) OR isset($_GET['custom'])) {
			$ref_no = isset($_POST['custom']) ? $_POST['custom'] : $_GET['custom'];
			$this->connect();
			$this->conn->query("DELETE FROM reservation WHERE ref_no = '".$ref_no."' ")
								or die("Error: ". $this->conn->error);
			$this->conn->close();

			return TRUE;
		}
	}


	function update_seat()
	{
		$passengers_id = $_POST['passengers_id'];
		$seat_no = $_POST['seat_no'];

		$this->connect();
		$this->conn->query("UPDATE reservation SET seat_no = '".$seat_no."' WHERE id = '".$passengers_id."'") or die("Error: ".$this->conn->error);
		$this->conn->close();

		header("Location: reserved_passengers.php");
	}

}
?>