<section>
	<!--  /* Form helper - action post - parsed to the registration model class*/-->
	<?php echo $form->create('Registration'); ?> 
		<fieldset>
			<label for="firstname" ></label> 
				<input type="text" name="firstname" id="firstname" />
			<label for="lastname" ></label> 
				<input type="text" name="lastname" id="lastname" />
			<select id="role">
				<?php //TO DO foreach loop roles get it from controller ?>
				<option value=""> </option>
				
				
				
				
			</select>	
		
		
		
		</fieldset>	
	
	
	<?php echo $form->end(); ?>	
</section
