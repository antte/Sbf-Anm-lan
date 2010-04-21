function showInfo() {
	$('.login_info').fadeIn(1000);
}

$(document).ready(function(){
	$('.login_info').hide();
	
	$('#AdminUsername').focus(showInfo());
	$('#AdminPassword').focus(showInfo());
	
});