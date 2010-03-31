$(document).ready(function(){
	$('.edit_link a').hover(
			  function () {
				    $(this).parents('div:first').addClass("hover");
				    $(this).parents('div:first').prevAll('div:first').addClass("hover");
				    
				  },
				  function () {
				    $(this).parents('div:first').removeClass("hover");
				    $(this).parents('div:first').prevAll('div:first').removeClass("hover");
				  }
				);
});