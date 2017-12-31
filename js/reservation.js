$(document).ready(function() {
	$(document).on("click find('.passengers-id')", 'button.btn-confirm', function(){

  		var passengers_id = ($(this).val());
  		
  		$.ajax({
			type: "POST",
			url: "confirm_reservation.php",
			data:
				{
			 		passengers_id: passengers_id
				}
		}).done(function(result){
		});
    });


	$(document).on('click', '#table-reservation tbody tr', function(){
		window.location = $(this).data("href");
	});

});