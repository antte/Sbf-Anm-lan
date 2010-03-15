<?php

	Class Registration extends AppModel {
		var $hasOne = "Registrator";
		var $belongsTo = "Event";
		var $hasMany = "Person";
		
	}