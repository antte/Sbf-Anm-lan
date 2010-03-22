<?php 
echo $form->create('people');
echo $form->input('first_name', array('type'=>'text','value'=>'Olle'));
echo $form->input('role', array('type' => 'text'));
echo $form->input('last_name', array('type' => 'text'));
echo $form->submit();
echo $from->end();