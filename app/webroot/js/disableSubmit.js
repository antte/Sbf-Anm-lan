$(document).ready(function() {
	
	/*
	 * A generic function that disables the last submit button found in the document and changes the button
	 * to a gray box with an animated gif, if the form validates properly
	 * Works like a charm on *any* page, so only include it on the one that you want this functionality on!
	 */
	
	$('input[type=submit]:last').click(function() {
		
		if( $(this).parents('form').valid() ){
			$('input[type=submit]:last')
				.attr({ disabled : 'disabled' })
				.css({ 
					'background' : '#888 url(../img/submitloading.gif) no-repeat 50% 50%',
					'color' : 'transparent',
					'cursor' : 'auto'
				});
		}
	});
	

});