$(document).ready(function() {
	$('a.changeEvent').hover(function(){
		$(this).append('<div id="result" style="float:right;color:#000;"></div>');
		$('#result').load('events #events');
	},function(){
		//$('#result').remove();
	});
});