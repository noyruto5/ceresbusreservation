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
			$seat_num = $this->input_validation($_POST['seat_no']);
			$array_seats = explode(',', $seat_num);
			$quantity = sizeof($array_seats);
			
			foreach ($array_seats as $seat_no) {
					
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
				$res = $this->conn->query("SELECT id, bus_no, class FROM bus_details
										WHERE date_departure = '".$date_departure."'
										AND time_departure = '".$time_departure."'
										AND route = '".$route."'
										") or die("Error: ".$this->conn->error);

				if ($res->num_rows > 0) {
					$row = $res->fetch_assoc();
					// $bd_id is foreign key to bus_details id
					$bd_id = $row['id'];
					$bus_no = $row['bus_no'];
					$bus_class = $row['class'];
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
							$ref_no_arr[] = $ref_no;

							$id = $this->conn->insert_id;
							if ($payment == "Paypal")
							{
								if (($route == "Sagay-Cebu Via Tolido" OR $route == "Sagay-Cebu Via Tabuelan") && $bus_class == "Air Conditioned")
								{
									$this->input_success = "<h1>Online Payment with Paypal</h1><br />
									<p>Please <strong>click</strong> the button below now and process the payment to confirm your reservation.
									<strong>Note: </strong>Cancelling the payment will cancel your reservation.</p><br/>
									<form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post' target='_top'>
									<input type='hidden' name='cmd' value='_s-xclick'>
									<input type='hidden' name='hosted_button_id' value='FTJZRKXYMDKH4'>
									<input type='hidden' name='custom' value='".implode(',', $ref_no_arr)."'>
									<input type='hidden' name='quantity' value='".$quantity."'>
			        				<input type='hidden' name='rm' value='2'>
									<input type='image' src='https://www.sandbox.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
									<img alt='' border='0' src='https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
									</form><br/><br/><a href='reservation_cancelled.php?id=$id' class='btn btn-default'>Cancel My Reservation</a>";
								}
								else if (($route == "Sagay-Cebu Via Tolido" OR $route == "Sagay-Cebu Via Tabuelan") && $bus_class == "Economy")
								{
									$this->input_success = "<h1>Online Payment with Paypal</h1><br />
									<p>Please <strong>click</strong> the button below now and process the payment to confirm your reservation.
									<strong>Note: </strong>Cancelling the payment will cancel your reservation.</p><br/>
									<form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post' target='_top'>
									<input type='hidden' name='cmd' value='_s-xclick'>
									<input type='hidden' name='hosted_button_id' value='CTBYZ3TV2U2J6'>
									<input type='hidden' name='custom' value='".implode(',', $ref_no_arr)."'>
									<input type='hidden' name='quantity' value='".$quantity."'>
			        				<input type='hidden' name='rm' value='2'>
									<input type='image' src='https://www.sandbox.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
									<img alt='' border='0' src='https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
									</form><br/><br/><a href='reservation_cancelled.php?id=$id' class='btn btn-default'>Cancel My Reservation</a>";
								}
								else //sagay-zamboanga
								{
									$this->input_success = "<h1>Online Payment with Paypal</h1><br />
									<p>Please <strong>click</strong> the button below now and process the payment to confirm your reservation.
									<strong>Note: </strong>Cancelling the payment will cancel your reservation.</p><br/>
									<form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post' target='_top'>
									<input type='hidden' name='cmd' value='_s-xclick'>
									<input type='hidden' name='hosted_button_id' value='FCGJUPSU7RJNW'>
									<input type='hidden' name='custom' value='".implode(',', $ref_no_arr)."'>
									<input type='hidden' name='quantity' value='".$quantity."'>
			        				<input type='hidden' name='rm' value='2'>
									<input type='image' src='https://www.sandbox.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
									<img alt='' border='0' src='https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
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
									    <tr><td><strong>Seat No.: </strong></td><td>".implode(', ', $array_seats)."</td></tr>
									    <tr><td><strong>Reference No.: </strong></td><td>".implode(', ', $ref_no_arr)."</td></tr>
									    </table>
									    <br/><br />
										<a href='reservation_form.php' class='btn btn-primary'>Reserve Another</a>";
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
						<table cellspacing='0' class='tbl-bus-seats'";

				echo ($_COOKIE['BASENAME'] == "reservation_form.php") ? "id='tbl-bus-st-in-form'" : "id='tbl-bus-st-in-rec'";

				echo ">
						<tr><th colspan='6' style='text-align:center;'>".$class." | Bus No. ".$bus_no."</th></tr>
						<tr><th colspan='6' align='left'>Driver Seat</th></tr>";

				$cell = 0;
				echo "<tr>";
						for ($i = 1; $i <= 3; $i++)
					  	{
					  		echo "<td "; 
					  		echo in_array($i, $array_seats) ? "class='filled'" : "class='unfilled'";
					  		echo ">$i</td>";
					  	}

					  echo "<td rowspan='8'></td>";

						for ($i = 4; $i <= 5; $i++)
					  	{
					  		echo "<td "; 
					  		echo in_array($i, $array_seats) ? "class='filled'" : "class='unfilled'";
					  		echo ">$i</td>";
					  	}

					  echo "</tr><tr>";

					  	for ($i = 6; $i <= 10; $i++)
					  	{
					  		echo "<td "; 
					  		echo in_array($i, $array_seats) ? "class='filled'" : "class='unfilled'";
					  		echo ">$i</td>";
					  	}
						
					  echo "</tr><tr>";

						for ($i = 11; $i <= 15; $i++)
					  	{
					  		echo "<td "; 
					  		echo in_array($i, $array_seats) ? "class='filled'" : "class='unfilled'";
					  		echo ">$i</td>";
					  	}
					  
					  echo "</tr><tr>";

						for ($i = 16; $i <= 20; $i++)
					  	{
					  		echo "<td "; 
					  		echo in_array($i, $array_seats) ? "class='filled'" : "class='unfilled'";
					  		echo ">$i</td>";
					  	}
					  
					  echo "</tr><tr>";

					  for ($i = 21; $i <= 25; $i++)
					  	{
					  		echo "<td "; 
					  		echo in_array($i, $array_seats) ? "class='filled'" : "class='unfilled'";
					  		echo ">$i</td>";
					  	}
					  
					  echo "</tr><tr>";

					  for ($i = 26; $i <= 30; $i++)
					  	{
					  		echo "<td "; 
					  		echo in_array($i, $array_seats) ? "class='filled'" : "class='unfilled'";
					  		echo ">$i</td>";
					  	}
					  
					  echo "</tr><tr>";

					  for ($i = 31; $i <= 35; $i++)
					  	{
					  		echo "<td "; 
					  		echo in_array($i, $array_seats) ? "class='filled'" : "class='unfilled'";
					  		echo ">$i</td>";
					  	}
					  
					  echo "</tr><tr>";

					  for ($i = 36; $i <= 40; $i++)
					  	{
					  		echo "<td "; 
					  		echo in_array($i, $array_seats) ? "class='filled'" : "class='unfilled'";
					  		echo ">$i</td>";
					  	}
					  
					  echo "</tr><tr>";

					  for ($i = 41; $i <= 46; $i++)
					  	{
					  		echo "<td "; 
					  		echo in_array($i, $array_seats) ? "class='filled'" : "class='unfilled'";
					  		echo ">$i</td>";
					  	}
					  
					  echo "</tr><tr>";

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

	// var cm is variable from paypal with custom value that we sent
	function payment_success() {
		if (isset($_POST['cm']) OR isset($_GET['cm'])) {
			$ref_no = isset($_POST['cm']) ? $_POST['cm'] : $_GET['cm'];
			$arr_ref_no = explode(',', $ref_no);

			$this->connect();

			foreach ($arr_ref_no as $ref_no)
			{
				//update the passengers reservation status
				$this->conn->query("UPDATE reservation SET status = 'confirmed' WHERE ref_no = '".$ref_no."'") or die("Error: ".$this->conn->error);
				
				//after extracting ref_no combine it again with each value quoted
				$ref_num = "'".$ref_no."'";
				$ref_num_arr[] = $ref_num;
				$ref_num_imp = implode(',', $ref_num_arr);
			}

			//get the passengers record
			$result = $this->conn->query("SELECT * FROM reservation JOIN users ON users.username = reservation.username WHERE ref_no IN ($ref_num_imp) ") or die("Error: ".$this->conn->error);

			if ($result->num_rows > 0)
			{
				while ($row = $result->fetch_assoc())
				{
					$date_departure = $row['date_departure'];
					$time_departure = $row['time_departure'];
					$route = $row['route'];
					$bus_no = $row['bus_no'];
					$seat_no_arr[] = $row['seat_no'];
					$seat_no_imp = implode(', ', $seat_no_arr);
					$ref_no_arr[] = $row['ref_no'];
					$ref_no_imp = implode(', ', $ref_no_arr);
				}
				$fname = $row['fname'];

				echo "<p>Thank you <strong>".ucfirst($fname)."</strong> for your payment. Your transaction has been completed, and a receipt for your purchase has been emailed to you.<br/> You may log into your account at www.paypal.com to view details of this transaction</p>
                      <br />
                      <br />
                      <p>Here's your reservation details.</p>
                      <table>
                        <tr><td><strong>Travel Schedule: </strong></td><td>".$date_departure."&nbsp;&nbsp;".$time_departure."</td></tr>
                        <tr><td><strong>Distination: </strong></td><td>".$route."</td></tr>
                        <tr><td><strong>Bus No.: </strong></td><td>".$bus_no."</td></tr>
                        <tr><td><strong>Seat No.: </strong></td><td>".$seat_no_imp."</td></tr>
                        <tr><td><strong>Reference No.: </strong></td><td>".$ref_no_imp."</td></tr>
                      </table>
                      <br />
                      <p><strong>Important Note: </strong>Present your reference number and 1 valid ID to sagay bus terminal to get your ticket.<br />Your reference number has been emailed to you ".$row['email'].".</p>";
				
				$to = $this->user_email();
				$subject = "Reservation reference number";
				$msg = "Your reference no.:\n".$ref_no_imp."\n";
				$msg.= "Sear number.:\n".$seat_no_imp."\n";
				mail($to, $subject, $msg);
			}
		} else {
		echo "No value sent.";
		}
	}


	function payment_cancel() {
		if (isset($_POST['cm']) OR isset($_GET['cm'])) {
			$ref_no = isset($_POST['cm']) ? $_POST['cm'] : $_GET['cm'];
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