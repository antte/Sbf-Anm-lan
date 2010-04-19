<?php
class AdminsController extends AppController {

	var $helpers = array('html','form','javascript');

	function login(){
		if ($this->data){
			if ( $username = $this->data['Admin']['username'] == 'user' && $password = $this->data['Admin']['password'] == 'pass'){
				$this->Session->write('adminLoggedIn', 'true');
				$this->redirect(array('controller' => 'admins' , 'action' => 'index'));
				
				
				//$this->Session->write('adminLoggedIn', 'true');
			} else {
				$this->set('errors'. $this->Admin->errors);
			}
			//no data not lopped here
		} else {

		}
	}

	function index(){
		// Logged in as admon do
		if($this->Session->check('adminLoggedIn')){
			
		// Not logged in do
		} else {
			$this->redirect(array('controller' => 'admins' , 'action' => 'login'));		
		}
	}

}

