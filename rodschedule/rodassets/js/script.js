function save()
{
	$("#btnSubmit").on("click", function() {

		    var $this 		    = $(this); //submit button selector using ID
        var $caption      = $this.html();// We store the html content of the submit button
        var form 			    = "#assign-sched-form"; //defined the #form ID
        var formData      = $(form).serializeArray(); //serialize the form into array
        var route 			  = $(form).attr('action'); //get the route using attribute action

    	$.ajax({
	        type: "POST", //we are using POST method to submit the data to the server side
	        url: route, // get the route value
	        data: formData, // our serialized array data for server side
	        success: function (response) {//once the request successfully process to the server side it will return result here
	            $this.attr('disabled', false).html($caption);
	            // We will display the result using alert

	        Swal.fire({
				  icon: 'success',
				  title: 'Success.',
				  text: response
				});


        $('#event_entry_modal').modal('toggle');

	        },
	        error: function (XMLHttpRequest, textStatus, errorThrown) {
	        	// You can put something here if there is an error from submitted request
	        }
            location.reload();
	    });

	});
}

$(document).ready(function() {

	save();

});
