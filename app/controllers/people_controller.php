<?php

class PeopleController extends AppController {
	var $helpers = array('Html','Form','Javascript');
	var $altName = 'Sällskap';
	var $altDescribe = 'Personer som ingår i ett sällskap';
	
	/**
	 * Inits the view for adding people (including amount of people) to the party
	 * @param unknown_type $amountOfPeople
	 */
	function beforeFilter(){
		$this->layout='registration';	
	}
	
	function create($amountOfPeople = null){
		
		if (!$this->previousStepsAreDone($this)){
			$this->requestAction('steps/redirectToNextUnfinishedStep');
		}
		
		//No event selected redirect to events
		if (!$this->Session->read('Registration.Registration.event_id')) {
			$this->redirect(array('controller' => 'events', 'action' => 'index'));	
		}
		//Is there populated data in session - get it else false 
		if ($this->Session->check('Registration.Person')) {
			$people = $this->Session->read('Registration.Person');
		} else {
			$people = false;
		}
		//Has user change the amount of people in the party
		if (isset($this->data['Person']['amount'])){
			$amountOfPeople = Sanitize::clean($this->data['Person']['amount']);
			if (!is_numeric($amountOfPeople)){
				$errors = $this->Session->read('errors');
				$errors['numeric'] = 'Du måste skriva in ett nummer';
				$this->Session->write('errors' , $errors);
			}			
		} 
		
		//Five state can be set to this point
		// 1 first time ever no people are stored in session and user havn't set amount of people in party
		if (!$people && !$amountOfPeople){
			$this->set('amountOfPeople', 1);	
		// The user come from another page and have already finished this step
		} elseif ($people && !$amountOfPeople){
			$amountOfPeople = sizeof($people);
			$this->set('amountOfPeople', $amountOfPeople);	
		// The people have finished this step and changed the amount of people to the same as populated in session	
		} elseif ($people && $amountOfPeople == sizeof($people)) {
			$this->set('amountOfPeople', $amountOfPeople);	
		//The people have finished this step and changed the amount of people to the less than populated in session				
		} elseif ($people && $amountOfPeople < sizeof($people)) {
			$people = array_slice($people, 0, $amountOfPeople);
			$this->set('amountOfPeople', $amountOfPeople);	
		//The people have finished this step and changed the amount of people to the more than populated in session				
		} elseif ($people && $amountOfPeople > sizeof($people)){
			$this->set('amountOfPeople', $amountOfPeople);	
		} else {
			$this->set('amountOfPeople', $amountOfPeople);	
		}
		
		//if we dont have people in session $people will be false
		$this->set('people', $people);	
		
		// Fetches data from the database from event and roles
		$eventId = $this->Session->read('Registration.Registration.event_id');
		$this->set('eventName' , $this->Person->Registration->Event->field('name', array('id' => $eventId)));
		$this->set('roles',$this->Person->Role->find('list'));
		$this->set('errors', $this->Session->read('errors'));
		$this->Session->write('errors',null);
		
	}
	
	function index() {
		
		if(!isset($this->params['requested'])) return;
		if(!$this->Session->check('adminLoggedIn')) return;
		if(!$this->Session->check('Event.id')) return;
		
		return $this->Person->listAllPeople($this->Session->read('Event.id'));
		
	}
	/**
	* Saves People to Session and redirects to next unfinished step
	*/
	function add($action = null){
		// Saves People in Session and redirects to next unfinished step
		if(isset($this->data['Person'])){
			$errors = $this->Person->validatesMultiple($this->data);
			if(empty($errors)) {
				//if we dont have errors all was successful and we continue with the registration
				$this->saveModelDataToSession($this);
				
				$this->updateStepStateToPrevious($this->params['controller'], $action);
				$this->requestAction('steps/redirectToNextUnfinishedStep');
			} else {
				$this->Session->write('errors.people', 'Du måste fylla i <strong>förnamn</strong>, <strong>efternamn</strong> och <strong>roll</strong> för alla personer.');
				$this->redirect(array('action' => 'create', sizeof($this->data['Person'])));
				
			}
		}
	}
	
	/**
	 * Returns true if you're changing people and false if you're not (you're there for the first time) 
	 */
	function sessionContainsPeople() {
		
		if(!isset($this->params['requested'])) return;

		return $this->Session->check('Registration.Person');
		
	}
	
	/*
	 * send the people from session to the drop down list in the view
	 */
	function getPeopleListFromSession(){
		$people = $this->Session->read('Registration.Person');
		$listOfPeople = array();
		foreach($people as $key => $person){
			$listOfPeople[$key] = $person['first_name'] . " " . $person['last_name'];
		}
		return $listOfPeople;
	}
	
	function addCodeToPersonInSession(){
		
		$this->data['Person']['code'] = strtoupper($this->data['Person']['code']);
		
		$userWantsToRemoveReductionCode = in_array('remove', array_keys($this->params['form']));
		
		//special case for when user presses the remove submit button
		if($userWantsToRemoveReductionCode) {
			//write empty string to reduction_code_id
			$this->Session->write('Registration.Person.' . $this->data['Person']['person'] . '.reduction_code_id', '');
			$firstName = $this->Session->read('Registration.Person.' . $this->data['Person']['person'] . '.first_name');
			$lastName = $this->Session->read('Registration.Person.' . $this->data['Person']['person'] . '.last_name');
			$this->Session->setFlash('Rabattkoden för ' . $firstName . ' ' . $lastName . ' är nu borttagen.');
			$this->redirectBack();
		}
		
		//OBS make sure to check this after userwantstoremovereductioncode because in that case we wont have code and we wont need it
		if(!$this->data['Person']['code']) {
			//code evaluates to false (for example its an empty string)
			//and the user doesnt want to remove the code (in which case we allow them to not write a code)
			$this->Session->setFlash('Du måste fylla i en rabattkod.');
			$this->redirectBack();
		}
		
		$eventId = $this->Session->read('Event.id');
		
		$reductionCodeId = $this->Person->ReductionCode->getIdByCodeAndEventId($this->data['Person']['code'], $eventId);

		//if the code does not exist ...

		if(!$this->Person->ReductionCode->codeExists($reductionCodeId)) {
			$this->Session->setFlash('<strong>Kontrollera din rabattkod, det verkar som om du har skrivit fel. Om felet kvarstår <a href="mailto:support@sbf.se">kontakta support</a>.</strong>');
			$this->redirectBack();
		}
		// ... or doesnt have people left on it give error message
		
		$maxPeopleWithCode = $this->Person->ReductionCode->getNumberOfPeopleById($reductionCodeId);
		$peopleWithCode = $this->Person->ReductionCode->getNumberOfPeopleWithCode($reductionCodeId, $this->Session->read('Registration'));
		
		if($peopleWithCode >= $maxPeopleWithCode) {
			$this->Session->setFlash('<strong>Det verkar som att rabattkoden redan är använd. Om det här är fel <a href="mailto:support@sbf.se">kontakta support</a>.</strong> :');
			$this->redirectBack();
		} else {
			$this->Session->write('Registration.Person.' . $this->data['Person']['person'] . '.reduction_code_id', $reductionCodeId);		
			$peopleWithCode = $this->Person->ReductionCode->getNumberOfPeopleWithCode($reductionCodeId, $this->Session->read('Registration'));
			$amountOfPeopleLeft = $maxPeopleWithCode - $peopleWithCode;  
			//Skicka med i flash hur många person som är kvar på rabattkoden 
			$this->Session->setFlash('<strong>Rabattkoden är nu tillagd och den har ' . $amountOfPeopleLeft . ' användningar kvar.</strong>');
		}
		$this->redirectBack();
		
	}
	
	function getListHeaders() {
		
		if(!isset($this->params['requested'])) return;
		
		$headers = $this->getHeaders();
		
		$headers[] = 'Roll';
		$headers[] = 'Bokningsnummer';
		
		return $headers;
		
	}
	
}	
