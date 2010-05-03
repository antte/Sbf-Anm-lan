<?php

	Class Role extends AppModel {
		
		var $exportAllowed = true;
		
		var $hasMany = array(
			"Person"
		); 
		
	}
