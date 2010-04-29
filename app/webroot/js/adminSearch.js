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
	
	// workaround: this extends the height of the a to match to height of the parent td
	// also because of a rendering feature, the td must have some content in order to properly align
	$('table#moduleIndex tbody td a').each(function(){
		if(this.innerHTML == "") {
			this.innerHTML = "&nbsp";
			$(this).addClass('nounderline');
		}
	});
	var tdheight = $('table#moduleIndex tbody td').height() - 10;
	$('table#moduleIndex tbody td a').each(function(){
		if($(this).attr('class').match(^.{6}) != 'button') {
			$(this).height(tdheight);
		}
	});

	
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