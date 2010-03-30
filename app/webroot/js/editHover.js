$(document).ready(function(){
	$('.edit_link a').hover(
			  function () {
				    $(this).parents('div:first').addClass("hover");
				    //$(this).parents('div').sibling
				    
				  },
				  function () {
				    //$(this).removeClass("hover");
				    $(this).parents('div:first').removeClass("hover");
				  }
				);
});