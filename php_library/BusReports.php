<?php
class BusReports extends SiteBasics {

	function read() {
		$this->connect();
		$yesterday = date("Y-m-d", strtotime("-1 days"));

		// get only the records of yesterday and below
		$result = $this->conn->query("SELECT * FROM bus_details WHERE date_departure <= '".$yesterday."' ORDER BY date_departure DESC");

		
		while($row = $result->fetch_assoc())
		{
			$bd_id = $row['id'];
			echo "<tr>
					<td>".$row['bus_no']."</td>
					<td>".$row['date_departure']."</td>
					<td>".$row['time_departure']."</td>
					<td>".$row['route']."</td>
					<td>".$row['full_load']."</td>";

			//count the number of passengers for this trip
			$result2 = $this->conn->query("SELECT count(id) AS id FROM reservation WHERE bd_id = '".$bd_id."' AND status = 'confirmed' ");

			if ( $result2->num_rows > 0 ) {
				$row2 = $result2->fetch_assoc();
				echo "<td>".$row2['id']."</td>";
			} else {
				echo "<td></td>";
			}

			echo "</tr>";
		}
	}
}
?>