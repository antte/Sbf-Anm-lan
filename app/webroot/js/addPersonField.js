
$(document).ready(function(){
	
	// Remove the add amount of people form and adds a button to add more people at the bottom
	$('#addamount').remove();
	$('#choosepeopleamount ol').after("<div class='grid_3'><a href='#' id='addField'>Lägg till fler personer</a></div>");
	
	//TODO check how many people fields already exists (only a problem when the user disables and then allows javascript in the middle of failure)
	var i = 0;
	
	
	$('#addField').click(function(){
		i++;
		
		// Inserts HTML-code for a new person field and fades it in
		$('#choosepeopleamount ol li:last').after(fieldValue(i));
		$('#choosepeopleamount ol li:last').hide().fadeIn('slow');
		
		// Removes a person field
		$('#choosepeopleamount ol li:last .removeField').click(function(){
			$(this).parents('li').fadeOut('500', function(){
				$(this).remove();
			});
			
			// TODO kolla om cake hanterar array med "fel" id:n, om inte behöver nedanstående funktion köras.
			//updateTimer = window.setTimeout("updateFieldIds()", 1000);
			return false;
		});
		
		return false;
	});
	
});

/**
 * @param i
 * @return the HTML code
 */
function fieldValue(i) {
	
	// TODO more handsome code!
	
	var string = "<li><fieldset class='name grid_8 alpha'>";
	string += 		"<div class='first_name grid_2'>";
				string += "<label for='Person" + i + "FirstName'>Förnamn *</label>";
				string += "<input type='text' id='Person" + i + "FirstName' class='required' value='' name='data[Person][" + i + "][first_name]'>";
			string += "</div>";
			string += "<div class='last_name grid_2'>";
				string += "<label for='Person" + i + "LastName'>Efternamn *</label>";
				string += "<input type='text' id='Person" + i + "LastName' class='required' value='' name='data[Person][" + i + "][last_name]'>";
			string += "</div>";
			string += "<div class='role grid_3'><label for='People" + i + "RoleId'>Anmäl dig som *</label>";
				string += "<select id='Person" + i + "RoleId' class='required' name='data[Person][" + i + "][role_id]'>";
					// Fetches the drop down code from the first person field
					string += $('select.role:first').html();
				string += "</select>";
			string += "</div>";
			string += "<div class='removeFieldDiv'><a href='#' class='removeField'>Ta bort</a></div>";
		string += "</fieldset>";
	string += "</li>";

	return string;
}

/*
TODO Denna funktion körs för att uppdatera namnvärdena, dock inte fungerande!

function updateFieldIds() {
	
	var numberOfLi = $('#choosepeopleamount li').length;
	console.log("updating your stuff");
	
	//gör nånting på alla li
	for( var i = 0; i < numberOfLi - 1; i++ ){
		$('#choosepeopleamount li').each(function(){
			
			// firstname
			$(this).find('.first_name input').attr('name', 'data[People][' + i + '][first_name]');
			
			// lastname
			$(this).find('.last_name input').attr('name', 'data[People][' + i + '][last_name]');
			
			// role
			$(this).find('.role select').attr('name', 'data[People][' + i + '][role_id]');
		});
	}
	
	clearTimeout(updateTimer);
}
*/
