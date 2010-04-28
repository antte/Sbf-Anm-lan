$(document).ready(function(){
	var aoColumnss = aoColumnsForDataTable();
	jsonColums = jQuery.parseJSON(aoColumnss);
	
	$('table#moduleIndex').dataTable({
		"aaSorting": [[ 1, "asc"]],
		"bPaginate": false,
		"aoColumns": jsonColums
	});
	
	
	//when someone hovers over a person, the whole company is highlighted
	$('table#moduleIndex tbody tr').hover(function(){
		
		//finds the booking number class of the tr
		var booking = $(this).attr('class').match("^.{6}").toString();

		$(this).addClass('hover');
		$('table#moduleIndex tbody .' + booking).addClass('companyhover');
		
	},function(){
		var booking = $(this).attr('class').match("^.{6}").toString();
		$(this).removeClass('hover');
		$('table#moduleIndex tbody .' + booking).removeClass('companyhover');
		
	});
	
	/*
	 * THIS IS CAUSING PROBLEMS LIKE CRAZY
	$('table#moduleIndex tbody td').click(function(){
		var url = window.location.protocol + "//" + window.location.host + $(this).find('a').attr('href');
		window.location.href = url;
		window.status = url;
	});
	*/
	
});

function aoColumnsForDataTable() {
	var count = $('table#moduleIndex thead th').length;
	
	var aoColumnsString = '[';
	for(var i = 0; i < count; i++){
		aoColumnsString += '{ "sSortDataType": "dom-text", "sType" : "html" }';
		aoColumnsString += (i == (count-1)) ? '': ',';
	}
	aoColumnsString +=']';
	
	return aoColumnsString;
}