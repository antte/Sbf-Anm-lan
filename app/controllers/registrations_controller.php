<?php

class RegistrationsController extends AppController {
	
	var $components = array('Email');
	
	/**
	 * Finalizes the registration (saving it)
	 */
	function finalize() {
		
		// The only thing registration needs right now is an event id
		$Registration['Registration']['event_id'] = $this->Session->read('Registration.Registration.event_id');
		$kolla = $Registration['Registration']['number'] = $this->Registration->generateUniqueNumber();
		$this->saveModelDataToSession('Registration', $Registration);		
		$registration = $this->Session->read('Registration');
		//debug($registration);
		if(!$this->Registration->saveAll($registration)) {
			$this->Session->del('Registration');
			$this->Session->setFlash('Vi ber om ursäkt, din registrering kunde inte slutföras. Kontakta support.');
			$this->redirect(array('controller' => 'events', 'action' => 'index'));
		} else {
		
			$this->Email->smtpOptions = array(
				'port'			=> '25', 
				'timeout'		=> '30',
				'host' 			=> 'localhost'
			);
			
			$this->Email->delivery 	= 'smtp';
			
			$this->Email->from		= 'Svenska bilsportförbundet Anmälan <anmalan@sbf.se>';
			$this->Email->to		= "{$registration['Registrator']['first_name']} {$registration['Registrator']['last_name']} <{$registration['Registrator']['email']}>";
			
			$eventName = $this->Registration->Event->findById($registration['Registration']['event_id'], array('fields' => 'name'));
			
			$this->Email->subject	= "Kvitto för din anmälan till $eventName";
			$this->Email->template	= 'receipt';
			$this->Email->sendAs	= 'both'; //both text and html
			$this->set('Registration', $registration);
			//Save boockingnumber delete everything else 
			$this->Session->write('booking_number',$registration['Registration']['number']);
			$this->Session->del('Registration');
			$this->Email->send();
			$this->redirect(array ('action' => 'receipt'));
		}
	}
	
	function clearSession() {
		$this->Session->del('Registration');
		$this->Session->setFlash('Session rensad');
		$this->redirect(array ('action' => 'create', 'controller' =>'registrator'));
	}
	
	function receipt() {
		$registration = $this->Session->read('booking_number');
		$registration['event_name'] = $this->Registration->Event->field('name',array('id'=> $registration['event_id'] ));
		//debug($registration);
		return $registration;
		
	}
	
	function getModuleReceipt(){
		
	}
	
}
