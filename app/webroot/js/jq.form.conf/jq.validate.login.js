$(document).ready(function(){
	
	$('#login').validate({ 
		rules: {
			'data[Registration][number]': {
				required: true,
				maxlength: 6
			},
			'data[Registrator][email]': {
	      		required: true,
	      		maxlength: 127,
	      		email: true
			}
		},
		messages: {
			'data[Registration][number]': {
				required: "Du måste fylla i bokningsnummer."
			},
			'data[Registrator][email]': {
				required: "Du måste fylla i e-postadress.",
				email: "Du måste fylla i en giltig e-postadress."
			}
		}
	});
	
	
	
});