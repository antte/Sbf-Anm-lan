<?php

	Class Registration extends AppModel {
		var $belongsTo = "Event";
		var $hasMany = "Person";
		
		var $validate = array(
        	'email' => 'email' /*TODO does this work?*/
    	);
		
	}