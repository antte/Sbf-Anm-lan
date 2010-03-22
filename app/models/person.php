<?php

	Class Person extends AppModel {

		var $belongsTo = array(
			"Role",
			"Registration" 
		);
		
	}
