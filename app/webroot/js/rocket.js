$(document).ready(function(){
	var change = false;
	
	$('form').change(function(){
		change = true;
	});
	
	$('#rocket a').click(function(){
        if(change){
			if(confirm('Är du säker på att du vill lämna sidan? Du kommer att förlora informationen du har skrivit in.')){
	            return true;
	        }else{
	            return false;
	        }
		} 
	});
	
	$('#adminPanel a').click(function(){
        if(change){
			if(confirm('Är du säker på att du vill lämna sidan? Du kommer att förlora informationen du har skrivit in.')){
	            return true;
	        }else{
	            return false;
	        }
		} 
	});
	
	
});