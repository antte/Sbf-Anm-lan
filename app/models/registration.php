<?php

	Class Registration extends AppModel {
		var $belongsTo = "Event";
		var $hasMany = "Person";
		
	}