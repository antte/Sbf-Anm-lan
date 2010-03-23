<?php
	class AppController extends Controller {
		//var $components = array('Security'); TODO kolla hur funkar
		
		/**
		 * Push something into an array in session (couldn't find this functionality anywhere)
		 * please improve this by using an existing function ;)
		 * @param string $arrayName
		 * @param mixed $dataToPush
		 */
		function pushToSessionArray($arrayName, $dataToPush) {
			$array = $this->Session->read($arrayName);
			$array[] = $dataToPush;
			$this->Session->write($arrayName, $array);
		}
	}