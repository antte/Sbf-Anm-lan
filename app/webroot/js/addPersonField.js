$(document).ready(function(){
	
	// Remove the add amount of people form and adds a button to add more people at the bottom
	$('#addamount').remove();
	$('#choosepeopleamount ol').after("<div class='grid_3'><a href='#' id='addField'>Lägg till fler personer</a></div>");
	
	//TODO check how many people fields already exists (only a problem when the user disables and then allows javascript in the middle of failure)

	var i = $('#PersonAddForm ol li').length;
	
	$('#addField').click(function(){
		
		
		
		// Inserts HTML-code for a new person field and fades it in
		var lastLi = $('#choosepeopleamount ol li:last');
		var newLi = lastLi.clone().insertAfter(lastLi);
		
		//('<li>' + $('#choosepeopleamount ol li:first').html() + '</li>');
		newLi.hide();
		fieldValue(i);
		newLi.fadeIn('slow');
		
		// Removes a person field
		$('#choosepeopleamount ol li:last .removeField').click(function(){
			$(this).parents('li').fadeOut('500', function(){
				$(this).remove();
			});
			return false;
		});

		i++;
		return false;
	});
	
	
	// Appends a delete button on all the li:s (except the first one) in edit mode
	$('#PersonAddForm.edit li:nth-child(1n+2) fieldset').each(function(){
		$(this).append('<a class="removeField" href="#">Ta bort</a>');
		$(this).find('a.removeField').click(function(){
			$(this).parents('li').fadeOut('500', function(){
				$(this).remove();
			});
			return false;
		});
	});
	
});

/**
 * Updates the last person field with the right values for the labels and inputs/selects
 * @param i
 */
function fieldValue(i) {

	var sel = $('#choosepeopleamount ol li:last');
	
	// First name
	sel.find('.first_name input').attr('value', '');
	sel.find('.first_name label').attr('for', 'Person' + i + 'FirstName');
	sel.find('.first_name input').attr('id', 'Person' + i + 'FirstName');
	sel.find('.first_name input').attr('name', 'data[Person][' + i + '][first_name]');
	
	// Last name
	sel.find('.last_name input').attr('value', '');
	sel.find('.last_name label').attr('for', 'Person' + i + 'LastName');
	sel.find('.last_name input').attr('id', 'Person' + i + 'LastName');
	sel.find('.last_name input').attr('name', 'data[Person][' + i + '][last_name]');
	
	// Roles
	sel.find('.role option:first').attr('selected', 'selected');
	sel.find('.role label').attr('for', 'Person' + i + 'RoleId');
	sel.find('.role select').attr('id', 'data[Person][' + i + '][role_id]');
	sel.find('.role select').attr('name', 'data[Person][' + i + '][role_id]');
	
	if(sel.find('a.removeField').length == 0) {
		sel.find('fieldset').append("<a href='#' class='removeField'>Ta bort</a>");
	}

}
