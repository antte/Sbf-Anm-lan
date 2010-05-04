<?php

	Class ReductionCode extends AppModel {
		
		var $exportAllowed = false;
		var $altName = 'Rabatter';
		var $hasMany = array(
			"Person"
		); 
		
	}
