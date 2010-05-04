<?php

	Class Role extends AppModel {
		
		var $exportAllowed = true;
		var $altName = 'Roller';
		var $hasMany = array(
			"Person"
		); 
		
	}
