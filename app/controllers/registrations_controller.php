<?php
class RegistrationsController extends AppController {
	
	function create() {
		if(!empty($this->data)) {
			if($this->Registration->save($this->data)) {
				//save successful TODO user needs feedback here
			}
		}
	}
	
}
