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
			//no data not looped here
		} else {

		}
	}

	function index($id = null ){
		$this->loadModel('Event');
		// Logged in as admin do
		if ($this->Session->check('adminLoggedIn')){
			if ($id) {
				$this->redirect(array('controller'=>'admins' , 'action' => 'events' ,$id));
			}
		$this->set('events', $this->Event->getEvents());
			
		// Not logged in do
		} else {
			$this->redirect(array('controller' => 'admins' , 'action' => 'login'));		
		}
	}
	
	function event($id){
		$event->$this->Event->getEvent($id);
		$this->set('Event' , $event);
		debug($this->Session->read());
		//$this->set('event',$this->params)		
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
		
		if ($this->Session->check('Event.id'))
			$steps = $this->requestAction('steps/getInitializedSteps/'. $this->Session->read('Event.id'));
		else
			return false;
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

