<?php

	Class Role extends AppModel {
		
		var $hasMany = array(
			"Registrator",
			"Person"
		); 
		
	}