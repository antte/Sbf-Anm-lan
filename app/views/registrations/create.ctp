<section>
	<!--  /* Form helper - action post - parsed to the registration model class*/-->
	<?php echo $form->create('Registration'); ?> 
		<fieldset>
<<<<<<< HEAD
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
			
			
=======
			<label for="firstname" ></label> 
				<input type="text" name="firstname" id="firstname" />
			<label for="lastname" ></label> 
				<input type="text" name="lastname" id="lastname" />
			<select id="role">
				<?php //TO DO foreach loop roles get it from controller ?>
				<option value=""> </option>
>>>>>>> e35b5ffdda186c54839710d8b26a6a1eb4d37cdb
				
				
				
				
<<<<<<< HEAD
			
=======
			</select>	
		
>>>>>>> e35b5ffdda186c54839710d8b26a6a1eb4d37cdb
		
		
		</fieldset>	
	
	
<<<<<<< HEAD
	<?php echo $form->end('Submit'); ?>	
</section> 
=======
	<?php echo $form->end(); ?>	
</section
>>>>>>> e35b5ffdda186c54839710d8b26a6a1eb4d37cdb
