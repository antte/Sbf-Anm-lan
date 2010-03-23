<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.dfwrein.com/html4-embed.dtd">
<html>
<head>
	<title>Foo</title>
	<script type="text/javascript" src="/site/code/jquery-1.2.2.pack.js"></script>
	<script type="text/javascript">
		(function($) {
			// Add repeat method to String object
			String.prototype.repeat = function(n){
				return new Array(n + 1).join(this);
			};
			// Add leading_zeros method to jQuery
			$.leading_zeros = function(n, total_digits){
				n = n.toString();
				return '0'.repeat(total_digits - n.length) + n;
			};
		})(jQuery);
		$(document).ready(function(){
			// initialize the counter
			var counter = 0;
			$('#fields-button').click(function(){
				// increment and pad the counter
				var padded_counter = $.leading_zeros(++counter, 3);
				// create the new field
				var extrafield = '<tr><td>List Item ' + padded_counter + '</td><td>';
				extrafield += '<input type="text" name="' + padded_counter + '"></td></tr>';
				// add the new field to the table
				$('#fields').append(extrafield);
			});
		});
	</script>
</head>
<body>
	<button id="fields-button">Add Field</button>
	<form action="some_srcipt.pl" method="get">
	<table id="fields"></table>
</form>
</body>
</html>








/*
$(document.body).click(function () {
    $("div:hidden:first").fadeIn("slow");
  });



<html>
<head>
    <title>Jobs - Extensible Form Demonstation</title>
    <script language="text/javascript" src="scripts/jquery.js"></script> 
    <script language="text/javascript">
      $(document).ready(function(){
        $("#addfield").click(function() {
          strFieldTitle = 'jobhistory';
          strNewField = '<tr><th>Job %</th><td><input type="text" name="job_%" id="job_%" /></td></tr>;
          addField(strFieldTitle, strNewField);
        });
      });

      function addField(strFieldTitle, strNewField) {      
        // We store a count of the total number of fields
        strCountField = '#' + strFieldTitle + '_count';      
        intFields = $(strCountField).val();

        // Create the new ID/Name for the form element by replacing % with the current field count 
        strNewField = strNewField.replace(/%/g, intFields);

        // Increment the total field count and update the count field
        intFields = Number(intFields) + 1;    
        $(strCountField).val(intFields); 

        //  Add the new field to the bottom of the table            
        $("#" + strFieldName + " tr:last").after(strNewField);    
      }
    </script>
  </head>
  <body>
    <h1>My Jobs</h1>
    <form>
      <input type="hidden" name="jobhistory_count" id="jobhistory_count" value="1" />
      <table id="jobhistory">
        <tr>
          <th>Job 1</th>
          <td><input type="text" name="job_0" id="job_0" /></td> 
        </tr>
      </table>
      <p><a href="http://allrite.net/webworld/#" id="addfield">[+] Add field</a></p>
    </form>
  </body>
</html>*/