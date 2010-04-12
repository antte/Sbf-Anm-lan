<?php

	Class Event extends AppModel {
		
		var $hasMany = "Registration"; 
		var $hasAndBelongsToMany = "Step";
		
	}
