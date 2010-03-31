<?php
	class RolesController extends AppController {
		
		function index() {
			if($this->params['requested']) {
				return $this->Role->find('all');
			} else {
				$this->redirect(array('controller' => 'events', 'action' => 'index'));
			}
		}
	}