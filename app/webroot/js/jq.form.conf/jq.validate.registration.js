$(document).ready(function(){
	
	$('#RegistratorAddForm').validate({ 
		rules: {
			'data[Registrator][first_name]': {
				required: true,
				maxlength: 127
			},
			'data[Registrator][last_name]': {
	      		required: true,
	      		maxlength: 127
			},
			'data[Registrator][role]': {
		    	required: true
	 		},
	 		'data[Registrator][email]': {
		    	required: true,
		    	maxlength: 127,
		    	email: true
	 		},
	 		'data[Registrator][retype_email]': {
		    	equalTo: "#RegistrationEmail",
		    	email: true
	 		},
	 		'data[Registrator][phone]': {		
				minlength: 7 
			},
			'data[Registrator][c_o]': {
	      		maxlength: 127
			},
			'data[Registrator][street_address]': {
		    	required: true,
		    	maxlength: 127
	 		},
	 		'data[Registrator][postal_code]': {
		    	required: true,
		    	regex: "^[0-9 ']{5,6}$"  

	 		},
	 		'data[Registrator][city]': {
		    	required: true,
		    	maxlength: 127
	 		}
		},
		messages: {
			'data[Registrator][postal_code]': {
				required: "Du måste fylla i en korrekt postkod.",
				regex: "Du måste fylla i en korrekt postkod."
			},
			'data[Registrator][retype_email]': {
				required: "Ange samma epost igen.",
				rangelenght: "Ange samma e-post igen.",
				digits: "Ange samma e-post igen."
			}
		}
	});
	
	
	
});