$(document).ready(function(){
	
	// Remove the add amount of people form and adds a button to add more people at the bottom
	$('#addamount').remove();
	$('#choosepeopleamount ol').after("<div class='grid_3'><a href='#' id='addField'>Lägg till fler personer</a></div>");
	
	//TODO check how many people fields already exists (only a problem when the user disables and then allows javascript in the middle of failure)
	//var i = 0;
	var i = $('#PersonAddForm ol li').length - 1;
	
	$('#addField').click(function(){
		
		i++;
		
		// Inserts HTML-code for a new person field and fades it in
		$('#choosepeopleamount ol li:last').after('<li>' + $('#choosepeopleamount ol li:first').html() + '</li>');
		$('#choosepeopleamount ol li:last').hide();
		fieldValue(i);
		$('#choosepeopleamount ol li:last').fadeIn('slow');
		
		// Removes a person field
		$('#choosepeopleamount ol li:last .removeField').click(function(){
			$(this).parents('li').fadeOut('500', function(){
				$(this).remove();
			});
			return false;
		});
		
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
	
	// First name
	$('#choosepeopleamount ol li:last').find('.first_name input').attr('value', '');
	$('#choosepeopleamount ol li:last').find('.first_name label').attr('for', 'Person' + i + 'FirstName');
	$('#choosepeopleamount ol li:last').find('.first_name input').attr('id', 'Person' + i + 'FirstName');
	$('#choosepeopleamount ol li:last').find('.first_name input').attr('name', 'data[Person][' + i + '][first_name]');
	
	// Last name
	$('#choosepeopleamount ol li:last').find('.last_name input').attr('value', '');
	$('#choosepeopleamount ol li:last').find('.last_name label').attr('for', 'Person' + i + 'LastName');
	$('#choosepeopleamount ol li:last').find('.last_name input').attr('id', 'Person' + i + 'LastName');
	$('#choosepeopleamount ol li:last').find('.last_name input').attr('name', 'data[Person][' + i + '][last_name]');
	
	// Roles
	$('#choosepeopleamount ol li:last').find('.role option:first').attr('selected', 'selected');
	$('#choosepeopleamount ol li:last').find('.role label').attr('for', 'Person' + i + 'RoleId');
	$('#choosepeopleamount ol li:last').find('.role select').attr('id', 'data[Person][' + i + '][role_id]');
	$('#choosepeopleamount ol li:last').find('.role select').attr('name', 'data[Person][' + i + '][role_id]');

	$('#choosepeopleamount ol li:last div:last').after("<a href='#' class='removeField'>Ta bort</a>");
}
