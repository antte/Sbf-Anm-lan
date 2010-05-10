$(document).ready(function(){
	
	//hide the reduction code fieldset on load
	$('fieldset.reduction_code').hide();
	
	//add helper rel to tr so js knows which person to add the code to
	var i = 0;
	var amountOfPeople = $('#receipt_entrants tbody tr').length;
	
	
	$('#receipt_entrants tbody tr').each(function(){
		$(this).attr('rel', i);
		
		//add icons to the table to add/remove depending on if there's already a code or not
		if($(this).children('td:last').text() == ""){
			$(this).children('td:last').append('<img src="../img/add.png" class="addCode">');
		} else {
			$(this).children('td:last').append('<img src="../img/remove.png" class="removeCode');
		}
		
		i++;
	});
	
	$('#receipt_entrants tbody img').click(function(){
		//find the other buttons and hide them until we've done something with the one we just clicked
		$(this).parents('tr').addClass('highlight').siblings('tr').each(function(){
			$(this).find('img').hide();
		});
		
		//find the person we clicked and set the value of the dropdown to that person
		var person = $(this).parents('tr').attr('rel');

		$('select#PersonPerson').children('option').each(function(){
			if($(this).attr('value') == person){
				$(this).attr('selected', 'selected');
			}
		});
		
		$('fieldset.reduction_code').show();
		$('fieldset.reduction_code .select').hide();
		
		
		
		//if we clicked an add button, hide the delete submit and vice versa
		if($(this).attr('class') == "addCode") {
			$('fieldset.reduction_code .remove').hide();
		} else {
			//hide the name field as well
			$('fieldset.reduction_code .input').hide();
			$('fieldset.reduction_code .create').hide();
		}
		
		//remove the clicked button
		$(this).remove();
	});
	
});