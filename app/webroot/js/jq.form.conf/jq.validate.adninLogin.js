$(document).ready(function(){
	
	$('#login').validate({ 
		rules: {
			'data[Admin][username]': {
				required: true,
			},
			'data[Admin][password]': {
	      		required: true,
	      		maxlength: 127,
			}
		},
		messages: {
			'data[Admin][username]': {
				required: "Du måste fylla i ditt Andvändarnamn."
					
			},
			'data[Admin][password]': {
				required: "Du måste fylla i Lösenord.",
			}
		}
	});
	
	
	
});