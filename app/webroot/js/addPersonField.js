$(document).ready(function(){
	$('#addamount').remove();
	$('#choosepeopleamount ol').after("<p id='addField'><span>+ </span>Lägg till fler personer</p>");
	
	var i = 0;
		
	$('#addField').click(function(){
		i++;
		$('#choosepeopleamount li:last-child').after(fieldValue(i));
		$('#choosepeopleamount li:last-child').hide().fadeIn('slow');
		console.log(i);
		
		
		$('#choosepeopleamount li:last-child .removeField').click(function(){
			$(this).parents('li').fadeOut('500', function(){
				$(this).remove();
			});
			
			// TODO kolla om cake hanterar array med "fel" id:n, om inte behöver nedanstående funktion köras.
			//updateTimer = window.setTimeout("updateFieldIds()", 1000);
		});
		
		
	});
	
});


function fieldValue(i) {

var roles = $('#People0RoleId').html();

	var string = "<li><fieldset class='name grid_8 alpha'>";
			string += "<div class='first_name grid_2'>";
				string += "<label for='People" + i + "FirstName'>Förnamn *</label>";
				string += "<input type='text' id='People" + i + "FirstName' value='' name='data[People][" + i + "][first_name]'>";
			string += "</div>";
			string += "<div class='last_name grid_2'>";
				string += "<label for='People" + i + "LastName'>Efternamn *</label>";
				string += "<input type='text' id='People" + i + "LastName' value='' name='data[People][" + i + "][last_name]'>";
			string += "</div>";
			string += "<div class='role grid_3'><label for='People" + i + "RoleId'>Anmäl dig som *</label>";
				string += "<select id='People" + i + "RoleId' name='data[People][" + i + "][role_id]'>";
					string += roles;
				string += "</select>";
			string += "</div>";
			string += "<p class='removeField'><span>X </span><br/>Ta bort person</p>";
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