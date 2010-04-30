<?php
App::import('Sanitize');

class AdminsController extends AppController {

	var $helpers = array('html','form','javascript');
	var $layout = "admin";
	var $defaultElementAction = "index";
	
	function beforeFilter() {
		
		$this->loadModel("Event");
		//debug($this->Session->read());
		//you can't visit any admin pages if you arent logged in as admin, with some exceptions
		if (!$this->Session->check('adminLoggedIn')) {
			$this->set('adminLoggedIn', 0);
			//if this action is not one of the permitted actions you are send to login
			if (!$this->actionPermittedWithoutLogin($this->params['action'])) {
				$this->redirect(array( 'controller' => 'admins' , 'action' => 'login' ));
			}
		} else {
			$this->set('adminLoggedIn' , $this->getCurrentAdminId());
		}
		
	}

	/**
	 * login action for login view also processes login when POSTed
	 */
	function login(){
		if ($this->data['Admin']){
			//the user wants to log in
			if($this->Admin->valid($this->data['Admin']['username'], $this->data['Admin']['password'])) {
				$admin = $this->Admin->findByUsername($this->data['Admin']['username']);
				$this->Session->write('adminLoggedIn', $admin['Admin']['id']);
				$this->chooseFirstActiveEvent();
			}
			$this->set('loginErrors', $this->Admin->loginErrors);
		}
	}
	
	/**
	 * Admins get here when they want to change event
	 */
	function events(){
		
		//if you're here we assume you want to change event so we "deselect" the current event from session
		$this->Session->del('Event');
		
		$this->set('events', $this->Event->getEvents());
		//$email = $this->Admin->resendConfirmEmail(($this->Session->read('Event', 'Registrator')));
		
		//return $email;
		
	}
	
	/**
	 * This is when you want to view an event, its kind of redundant
	 * @param $id
	 */
	function event($id){
		
		$event = $this->Event->find('first', array('conditions' => array('id' => $id) , 'recursive' => 0) );
		
		$this->set('event' , $event);
		
	}
	
	function logout() {
		
		// clear session
		$this->Session->del('Registration');
		$this->Session->del('Event');
		$this->Session->del('errors');
		$this->Session->del('adminLoggedIn');
		$this->Session->del('loggedIn');
		
		$this->Session->setFlash("Du har nu loggat ut!", 'default', array('class' => 'loggedOut'));
		
		//when you have logged out you get redirected to login
		$this->redirect(array('controller' => 'admins' , 'action' => 'login'));

	}
	
	/**
	 * Made to be requested by the admin panel to recieve steps
	 * Step state becomes step classes (similar to the usual rocket view for steps seen when making a registration)
	 * @return admin steps (event steps without review and receipt)
	 */
	function steps( $controller = null ) {
		$controller = Inflector::camelize($controller);
		if(!isset($this->params['requested'])) return;
		
		//if we can't find eventId we wont be able to find steps
		if (!$this->Session->check('Event.id')) return;	
		$steps = $this->requestAction('steps/getInitializedSteps/'. $this->Session->read('Event.id'));
		
		/**
		 * remove registration review and registration receipt from steps before returning
		 */
		$adminSteps = array();
		foreach ($steps as $key => $step) {
			if (!$step['admin_label']) {
				continue;
			}
			
			if ($step['controller'] == $controller){
				$adminSteps[$key]['classes'] = 'current';
			}
			else {
				$adminSteps[$key]['classes'] = $step['state'];
			}
			$adminSteps[$key]['admin_label'] = $step['admin_label'];
			$adminSteps[$key]['controller'] = $step['controller'];
			$adminSteps[$key]['action'] = $step['action'];
			$adminSteps[$key]['order'] = $step['order'];
			
		}
		return $adminSteps;
	
	}
	
	/**
	 * TODO remove on deploy
	 * @param $username
	 * @param $password
	 */
	function newAdmin($username, $password) {
		if( !(Configure::read('debug') >= 1) ) return;
		$admin['Admin']['username'] = $username;
		$admin['Admin']['password'] = md5($password);
		$this->Admin->save($admin);
	}
	
	function checkAdminLoggedIn() {	
		return $this->Session->check('adminLoggedIn'); 
	}
	
	/**
	 * The view renders the index element of the controller (ex app/views/elements/registrators/index.ctp) 
	 * the user is currently on. (selected in the panel)
	 */
	function eventindex() {
		
		// elementUrl dicides which element the view renders 
		if ($this->params['pass']) {
			$elementUrl = $this->params['pass'][0] . '/' .  $this->defaultElementAction; 
		} else {
			
			/* 
			 * the only purpose of this next line is that
			 * the admin panel checks in pass for the current action
			 * so that it can display which "step" is "current"
			 */ 
			$this->params['pass'][0] = 'registrators/' . $this->defaultElementAction;
			
			$elementUrl = 'registrators/' . $this->defaultElementAction;
			
		}
		
		$this->set('elementUrl' , $elementUrl);
		
	}
	
	/**
	 * Puts the event in session and redirects to registrations
	 * @param $id the id of an event
	 */
	function chooseEvent($id) {
		$this->requestAction('events/setEvent/'. $id);
		$this->redirect( array('action' => 'eventindex'));
	}
	
	/**
	 * Find first active event and runs chose event on it
	 */
	private function chooseFirstActiveEvent() {
		$event = $this->Event->findFirstActiveEvent();
		$this->chooseEvent($event['Event']['id']);
	}
	
	/**
	 * Puts registration in session and redirects to the specified registration number
	 */
	function putRegistrationInSessionAndRedirect($registrationNumber) {
		
		$registrationNumber = Sanitize::clean($registrationNumber);
		
		$registration = $this->Event->Registration->findByNumber($registrationNumber);
		
		$this->Event->Registration->putRegistrationInSession($registration, $this->Session);
		
		//all steps up until review are set to previous so that redirectToNextUnfinished redirects to the right step
		$this->setPreviousStepsToPrevious('Registrations','review');
		
		$this->requestAction('steps/redirectToNextUnfinishedStep');
	}
	
	/**
	 * @return int current admins.id
	 */
	function getCurrentAdminId() {
		
		if(!isset($this->params['requested'])) return;
		
		return $this->Session->read('adminLoggedIn');
		
	}
	
	/**
	 * If the specified action is permitted to be visited wihtout login this function returns true
	 * @action string
	 */
	private function actionPermittedWithoutLogin($action) {
		
		if($action == 'login') return true;
		if($action == 'checkAdminLoggedIn') return true;
		
		return false;
		
	}


	function resendConfirmMail($registrationNumber) {
		$this->requestAction('registrations/resendConfirmMail/' . $registrationNumber);
		$this->Session->setFlash('<h4 class="login_info grid_12">Ett bekräftelsemail har skickats</h4>');
		$this->redirect('/admins/eventindex/registrators');
	}	

	
	function getAdminUsernameById($id) {
		if(!isset($this->params['requested'])) return;
		return $this->Admin->getAdminUsernameById($id);
	}
	/**
	 * 
	 * @param unknown_type $modelName
	 */
	function getModelDump($modelName) {
		$this->loadModel($modelName);
		$modelName = mb_convert_encoding($modelName, "SJIS","UTF-8");
		$eventId = $this->Session->read('Event.id');
		
		// the database model doesn't support a single find method for all the models
		if($modelName == 'Registrations'){
			$this->Event->$modelName->findByEventId($eventId, array('recursive' => -1));
		}
		
		elseif($modelName == 'Registrator') {
			$this->Registration->$modelName->find('all', array('recursive' => -1, 'conditions' => array('Registration.event_id' => $eventId)));
		}
		
		else {
			return $this->$modelName->find('all', array('recursive' => -1));
		}
	}
	
	function excelExport($modelName) {
		$this->layout = "excel";
	}
	
	function getExcelExportOptions() {
		if(!isset($this->params['requested'])) return;
		
		return $exportOptions = array(
			'Registration',
			'Registrator',
			'Person',
			'Role',
			'Event',
			'Admin'
		);
		
	}
	
}

	


