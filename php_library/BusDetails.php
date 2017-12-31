<?php
class BusDetails extends SiteBasics{

	protected $field;
	
	function read() {

		$this->connect();

		$result = $this->conn->query("SELECT * FROM bus_details ORDER BY date_departure ASC");

		
		while($row = $result->fetch_assoc())
		{
			echo "<tr>
					<td>".$row['bus_no']."</td>
					<td>".$row['date_departure']."</td>
					<td>".$row['time_departure']."</td>
					<td>".$row['route']."</td>
					<td>".$row['class']."</td>
					<td>".$row['full_load']."</td>";
					if ($this->get_role() != 'guest') {
						echo "<td><div class='tooltip-demo'><a href='edit_bus_details_form.php?id=$row[id]' data-toggle='tooltip' data-placement='top' title='Edit Record'><i class='fa fa-edit'></i></a>&nbsp;&nbsp;
							<a href='delete_bus_details.php?id=$row[id]' class='bd-btn-delete' data-toggle='tooltip' data-placement='top' title='Delete Record' onclick='return confirm(\"Are you sure you want to delete?\")'><i class='fa fa-trash'></i></a></div></td>";
					}
			  
			echo "</tr>";
		}
	}


	function create() {

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
		{
			$this->connect();

			//check if filled up completely
			if ( isset($_POST['bus_no']) 
				&& isset($_POST['date_departure']) 
				&& isset($_POST['time_departure']) 
				&& isset($_POST['route'])
				&& isset($_POST['class']) )
			{
				$bus_no = $_POST['bus_no'];
				$date_departure = $_POST['date_departure'];
				$time_departure = $_POST['time_departure'];
				$route = $_POST['route'];
				$class = $_POST['class'];


				//check for duplicate records
				$result = $this->conn->query("SELECT * FROM bus_details 
											WHERE bus_no = '".$bus_no."' 
											AND date_departure = '".$date_departure."'
											AND time_departure = '".$time_departure."'
											AND route = '".$route."' ");

				if ( $result->num_rows == 0 )
				{
					$full_load = "no";
					$stmt = $this->conn->prepare("INSERT INTO bus_details (bus_no, date_departure, time_departure, route, class, full_load) 
					VALUES (?, ?, ?, ?, ?,?)");
					$stmt->bind_param("isssss", $bus_no, $date_departure, $time_departure, $route, $class, $full_load);
					$stmt->execute() or die("Error: ".$this->conn->error);
					$stmt->close();
					$this->conn->close();

					$this->input_success = "1 record have been saved successfully.";
				}
				else
				{
					$this->input_warning = "*Records cannot be save. Duplicate records is not allowed.";
				}

			}
			else
			{
				$this->input_warning = "Please fill the required fields.";
			}
		} 
	}


	function update() {
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
		{
			$this->connect();

			//check if filled up completely
			if ( isset($_POST['bus_no']) 
				&& isset($_POST['date_departure']) 
				&& isset($_POST['time_departure']) 
				&& isset($_POST['route'])
				&& isset($_POST['id']) )
			{
				$bus_no = $_POST['bus_no'];
				$date_departure = $_POST['date_departure'];
				$time_departure = $_POST['time_departure'];
				$route = $_POST['route'];
				$id = $_POST['id'];

				//check for duplicate records
				$result = $this->conn->query("SELECT * FROM bus_details 
											WHERE bus_no = '".$bus_no."' 
											AND date_departure = '".$date_departure."'
											AND time_departure = '".$time_departure."'
											AND route = '".$route."'
											AND id != '".$id."' ");

				if ( $result->num_rows == 0 )
				{
					$sql = "UPDATE bus_details SET bus_no=?, date_departure=?, time_departure=?, route=? WHERE id=? ";

					if ($stmt = $this->conn->prepare($sql)) {
						$stmt->bind_param('dsssd', $bus_no, $date_departure, $time_departure, $route, $id);
					    $stmt->execute();
					    $stmt->close();
					    $this->conn->close();
					    //$this->input_success = "1 record have been saved successfully.";
					    return TRUE;
					}
					
				}
				else
				{
					$this->input_warning = "*Records cannot be save. Duplicate records is not allowed.";
				}

			}
			else
			{
				$this->input_warning = "Please fill the required fields.";
			}
		} 
	}


	function delete() {
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$this->connect();
			$this->conn->query("DELETE FROM bus_details WHERE id = '".$id."' ") or die("Error: ". $this->conn->error);
			$this->conn->close();

			return TRUE;
		}
	}


	/*
	* Getters function
	*/
	function get_field_val($field) {
		if (isset($_GET['id'])) {
			$this->connect();
			$id = $_GET['id'];

			$sql = "SELECT $field FROM bus_details WHERE id = '".$id."' ";

			if ($stmt = $this->conn->prepare($sql)) {
			    $stmt->execute();
			    $stmt->bind_result($field);
			    while ($stmt->fetch()) {
			        $this->field = $field;
			    }
			    $stmt->close();
			    $this->conn->close();

			    return $this->field;
			}
		}
	}
}
?>