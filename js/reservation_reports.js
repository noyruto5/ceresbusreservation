$(document).ready(function() {

	$("#daily .btn-show").click(function(){
      	var month = $("#daily .month").val();
       	var year = $("#daily .year").val();
       	if (month != "Month" && year != "Year") {
       		
       		// need to clear the previous chart of this canvas
       		dailyChart.destroy();

       		$.ajax({
			type: "POST",
			url: "reservation_daily_chart.php",
			data:
				{
			 		month: month,
					year: year
				}
			}).done(function(result){
				$("#daily-script-holder").html(result);
			});
		}
       	
    });


    $("#monthly .btn-show").click(function(){
       	var year = $("#monthly .year").val();
       	if (year != "Year") {

       		monthlyChart.destroy();

       		$.ajax({
    			type: "POST",
    			url: "reservation_monthly_chart.php",
    			data:
    				{
    					year: year
    				}
    			}).done(function(result){
    				$("#monthly-script-holder").html(result);
    			});
         }
    });


    $("#yearly .btn-show").click(function(){
      	var year_frm = $("#yearly #year-from").val();
       	var year_to = $("#yearly #year-to").val();
       	if (year_frm != "From Year" && year_to != "To Year") {
       		
          yearlyChart.destroy();

          $.ajax({
          type: "POST",
          url: "reservation_yearly_chart.php",
          data:
            {
              year_frm: year_frm,
              year_to: year_to
            }
          }).done(function(result){
            $("#yearly-script-holder").html(result);
          });
       	}
    });
});