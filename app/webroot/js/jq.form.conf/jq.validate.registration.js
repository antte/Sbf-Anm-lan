$(document).ready(function(){
	
	$('#RegistrationAddForm').validate({ 
		rules: {
			'data[Registration][first_name]': {
				required: true,
				maxlength: 127
			},
			'data[Registration][last_name]': {
	      		required: true,
	      		maxlength: 127
			},
			'data[Registration][role]': {
		    	required: true
	 		},
	 		'data[Registration][email]': {
		    	required: true,
		    	maxlength: 127,
		    	email: true
	 		},
	 		'data[Registration][retype_email]': {
		    	equalTo: "#RegistrationEmail",
		    	email: true
	 		},
	 		'data[Registration][phone]': {		
				minlength: 7 
			},
			'data[Registration][c_o]': {
	      		maxlength: 127
			},
			'data[Registration][street_address]': {
		    	required: true,
		    	maxlength: 127
	 		},
	 	'data[Registration][postal_code]': {
		    	required: true,
		    	regex: "^[0-9 ']{5,6}$"  

	 		},
	 		'data[Registration][city]': {
		    	required: true,
		    	maxlength: 127
	 		}
		},
		messages: {
			'data[Registration][postal_code]': {
				required: "Du måste fylla i en korrekt postkod.",
				regex: "Du måste fylla i en korrekt postkod."
			},
			'data[Registration][retype_email]': {
				required: "Ange samma epost igen.",
				rangelenght: "Ange samma e-post igen.",
				digits: "Ange samma e-post igen."
			}
		}
	});
	
	
	
});