$(document).ready(function(){
	var aoColumnss = aoColumnsForDataTable();
	jsonColums = jQuery.parseJSON(aoColumnss);
	
	$('table#moduleIndex').dataTable({
		"bPaginate": false,
		"aoColumns": jsonColums
	});
	
	
	//when someone hovers over a person, the whole company is highlighted
	$('table#moduleIndex tbody tr').hover(function(){
		
		//finds the booking number class of the tr
		var booking = $(this).attr('class').toString().match("^.{6}");

		$(this).addClass('hover');
		$('table#moduleIndex tbody .' + booking).addClass('companyhover');
		
	},function(){
		var booking = $(this).attr('class').toString().match("^.{6}");
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
		var className = $(this).attr('class').toString().match("^.{6}");
		if( className != 'button') {
			$(this).height(tdheight);
		}
		
	});
	
	
	//animate in the delete verification box and then hide it after 10 sec
	$('.admin_info').hide().show(500).delay(9000).hide(500);
	
	
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