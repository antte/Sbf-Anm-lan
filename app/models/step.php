<?php
	class Step extends AppModel {
		var $hasAndBelongsToMany = "Event";
		
		var $steps = array(
			'Person' => array(
				'current_step' => true,
				'label' => 'Sällskap',
			),
			'Registrator' => array(
				'current_step' => false,
				'label' => 'Kontaktuppgifter',
			),
			'Review' => array(
				'current_step' => false,
				'label' => 'Granska',
			),
			'Receipt'=> array(
				'current_step' => false,
				'label' => 'Kvitto',
			)
		);
		
		
	}
