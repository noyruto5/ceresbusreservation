$(document).ready(function(){

	$(document).on('click', '#available-seat-btn', function(){
		$date_departure = $("#date_departure").val();
		$time_departure = $("#time_departure").val();
		$route = $("#route").val();

		$.ajax({
			type: "POST",
			url: "bus_seats.php",
			data:
				{
			 		date_departure: $date_departure,
					time_departure: $time_departure,
					route: $route
				}
		}).done(function(result){
			$(".modal-body").html(result);
		});
		
	});
});