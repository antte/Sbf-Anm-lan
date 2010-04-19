<?php
class AdminsController extends AppController {

	var $helpers = array('html','form','javascript');

	function login(){
		if ($this->data){
			if ( $username = $this->data['Admin']['username'] == 'user' && $password = $this->data['Admin']['password'] == 'pass'){
				$this->Session->write('adminLoggedIn', 'true');

				$this->redirect(array('controller' => 'admins' , 'action' => 'index'));
				
				$this->redirect(array('controller' => 'Admin' , 'action' => 'index'));
				
				
				//$this->Session->write('adminLoggedIn', 'true');
			} else {
				$this->set('errors'. $this->Admin->errors);
			}
			//no data not looped here
		} else {

		}
	}

	function index(){
		// Logged in as admin do
		if($this->Session->check('adminLoggedIn')){
			
		// Not logged in do
		} else {
			$this->redirect(array('controller' => 'admins' , 'action' => 'login'));		
		}
	}
	
	function logout() {
		//deletes the user session
		$this->Session->del('adminLoggedIn');
		$this->Session->setFlash("Du har nu loggat ut!");
		//when you have logged out you get redirected to login
		$this->redirect(array('controller' => 'Admin' , 'action' => 'login'));
	}
	
	/**
	 * Made to be requested by the admin panel
	 * @return admin steps (event steps without review and receipt)
	 */
	function steps() {
		
		if(!isset($this->params['requested'])) return;
		
		$steps = $this->requestAction('steps/getInitializedSteps/'. $this->Session->read('Event.id'));
		
		/**
		 * remove registration review and registration receipt from steps before returning
		 */
		foreach ($steps as &$step) {
			if ( $step['controller'] == 'Registrations' && 
			( $step['action'] == 'review' || $step['action'] == 'receipt' ) ) {
				unset($step);
				continue;
			}
			$step['classes'] = $step['state'];
			unset($step['state']);
		}
		
		return $steps;
	}
	
}

