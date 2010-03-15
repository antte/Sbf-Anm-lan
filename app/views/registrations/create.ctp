<section>
	<!--  /* Form helper - action post - parsed to the registration model class*/-->
	<?php echo $form->create('Registration'); ?> 
		<fieldset>
			<label for="firstname" >Förnamn </label> 
				<input type="text" name="first_name" id="firstname" />
			
			<label for="lastname" >Efternamn </label> 
				<input type="text" name="last_name" id="lastname" />
			
			<label>Anmäl dig som</label>
				<select id="role">
					<?php //TODO foreach loop roles get it from controller ?>
					<option value=""> </option>
				</select>	
			
			<label for="email" >E-post:</label> 
				<input type="text" name="email" id="email" />
			<label for="phone" >Telefon:</label> 
				<input type="text" name="phone" id="phone" />
			<label for="c_o" >c/o:</label> 
				<input type="text" name="c_o" id="c_o" />
			<label for="street_address" >Adress:</label> 
				<input type="text" name="street_address" id="street_address" />
			<label for="postal_code" >Postnr:</label> 
				<input type="text" name="postal_code" id="postal_code" />
			<label for="city" >Stad:</label> 
				<input type="text" name="city" id="city" />
			
			
				
				
				
				
			
		
		
		</fieldset>	
	
	
	<?php echo $form->end('Submit'); ?>	
</section> 
