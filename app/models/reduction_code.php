<?php

	Class ReductionCode extends AppModel {
		
		var $exportAllowed = true;
		var $altName = 'Rabatter';
		var $hasMany = array(
			"Person"
		); 
		
	}
