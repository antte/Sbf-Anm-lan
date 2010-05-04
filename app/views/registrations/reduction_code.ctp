<div class="grid_12">
	<div class="grid_full">
		<h2>Fyll i din rabattkod</h2>
	</div>
</div>

<p class="requiredinfo">Fält markerade med * är obligatoriska uppgifter!</p>
	<?php
		echo $form->input('code', array('type' => 'text', 'label' => 'Rabattkod *', 'div' => 'code grid_3', 'maxLength' => '127', 'default' => $registrator['code']));
		echo $form->input('number_of_people', array('type' => 'text', 'label' => 'Antal Personer *', 'div' => 'number_of_people grid_3', 'maxLength' => '127', 'default' => $registrator['number_of_people']));
	?>