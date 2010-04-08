$(document).ready(function(){
	$('#rocket a').click(function(){
        if(confirm('Är du säker på att du vill lämna sidan? Du kommer att förlora informationen du har skrivit in.')){
            return true;
        }else{
            return false;
        }
	});
});