$(document).ready(function(){
	
	var busno_setA = {"532": "532",
		"535": "535",
		"537": "537",
		"517": "517",
		"55001": "55001",
		"555": "555"
	};

	var busno_setB = {"5775": "5775",
		"5776": "5776"
	};

	var time_depA = {"6:30 AM - 10:30 AM": "6:30 AM - 10:30 AM",
		"10:00 AM - 2:00 PM": "10:00 AM - 2:00 PM",
		"12:00 PM - 4:00 PM": "12:00 PM - 4:00 PM",
		"8:00 PM - 12:00 AM": "8:00 PM - 12:00 AM",
		"11:00 PM - 3:00 AM": "11:00 PM - 3:00 AM",
		"1:00 AM - 5:00 AM": "1:00 AM - 5:00 AM"
	};

	var time_depB = {"8:00 AM - 8:00 PM":"8:00 AM - 8:00 PM"}

	var bus_no_list = [];
	$("#add_bus_detail_route").change(function(){
		var route = $(this).val();
		var el = $("#add_bus_detail_bus_no");
		var el2 = $("#add_bus_details_time_dep");

		if (route.toLowerCase() == "sagay-zamboanga") {
			el.empty();
			$.each(busno_setB, function(key,value) {
			el.append($("<option></option>")
			   .attr("value", value).text(key));
			});


			el2.empty();
			$.each(time_depB, function(key,value) {
			el2.append($("<option></option>")
			   .attr("value", value).text(key));
			});
		}
		else {
			el.empty();
			$.each(busno_setA, function(key,value) {
			el.append($("<option></option>")
			   .attr("value", value).text(key));
			});

			el2.empty();
			$.each(time_depA, function(key,value) {
			el2.append($("<option></option>")
			   .attr("value", value).text(key));
			});
		}

	});


	$(document).on("click find('#tbl-bus-st-in-rec td')", '#tbl-bus-st-in-rec td.unfilled', function(){
  		var seat_no = ($(this).text());
  		$("#seat_no").val(seat_no);
  		$("#label_seat_no").text(seat_no);

  		$(this).toggleClass("cellClick-fade");
    });


	var seats = [];
	$(document).on("click find('#tbl-bus-st-in-form td')", '#tbl-bus-st-in-form td.unfilled', function(){

  		var seat_no = ($(this).text());
  		// store to array all seats being cliked
  		// check if value already exist
  		if (seats.indexOf(seat_no) > -1) {
  			// value exist
  		} else {
  			// value don't exist
  			seats.push(seat_no);
  		}

  		$("#seat_no").val(seats);
  		$("#label_seat_no").text(seats);

  		$(this).addClass("cellClick");

    });

    $("#btn-cancel").click(function(){
    	$("#seat_no").val(null);
    	$("#label_seat_no").text("0");

    	// Clear seats
    	seats = [];
    });

});