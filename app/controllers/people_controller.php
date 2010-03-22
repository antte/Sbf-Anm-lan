<?php
	class PeopleController extends AppController {
		
		var $helpers = array('Form', 'Html', 'Javascript');
		
		function index(){
			$this->redirect( array('action' => 'create'));
		}
		
		function add(){
			//debug me


			$this->redirect( array('action' => 'create', $this->data['amount']));
			
		}
		
		function create() {
			//debug me
			
			$amount = $this->data['amount'];
			
			if(!$amount){
				$amount = 1;
			}
			
			$this->set('amountOfPeople', $amount );
			//$this->redirect( array('action' => 'create'));
			
		}
		
	}