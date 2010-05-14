<?php 
	echo $form->create('Registration', array('action' => 'test'));
	echo $form->input('Registration.event_id', array('default' => '7'));
	echo $form->input('Registration.number', array('default' => 'GGGGG1'));
	echo $form->input('Invoice.0.Item.0.price', array('default' => '322'));
	echo $form->input('Invoice.0.Item.0.description', array('default' => 'sdffgh'));
	echo $form->input('Invoice.0.Item.1.price', array('default' => '322222'));
	echo $form->input('Invoice.0.Item.1.description', array('default' => 'zzzzzzzzz'));
	echo $form->end("asf");
?>