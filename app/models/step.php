<?php
	class Step extends AppModel {
		
		var $hasAndBelongsToMany = "Event";
		//var $exportAllowed = true;
		
		/**
		 * Populates and returns an initialized steps array that can be used by the step view.
		 * @param $eventId
		 */
		function getInitializedSteps($eventId){
			$event = $this->Event->findById($eventId);
			$steps = $event['Step'];
			$rocket = array();
			/*
				Flattens the steps array
			*/
			foreach($steps as $step) {
				$key = $step['controller'] .'/'. $step['action'];
				$rocket[$key]['label'] = $step['name'];
				$rocket[$key]['state'] = 'coming';
				$rocket[$key]['controller'] = $step['controller'];
				$rocket[$key]['action'] = $step['action'];
				$rocket[$key]['order'] = $step['EventsStep']['order'];
				$rocket[$key]['admin_label'] = $step['admin_label'];
			}	
			return $this->multisort($rocket,'order','label','action', 'controller','state','admin_label');
		}
		
		/**
		* Sort by $sort_by and don't return $key1, $key2, ... etc.
		*/
		private function multisort($array, $sort_by, $key1, $key2=NULL, $key3=NULL, $key4=NULL, $key5=NULL, $key6=NULL){
		    // sort by ?
		    foreach ($array as $pos =>  $val)
		        $tmp_array[$pos] = $val[$sort_by];
		    asort($tmp_array);
		   
		    // display however you want
		    foreach ($tmp_array as $pos =>  $val){
		        $return_array[$pos][$sort_by] = $array[$pos][$sort_by];
		        $return_array[$pos][$key1] = $array[$pos][$key1];
		        if (isset($key2)){
		            $return_array[$pos][$key2] = $array[$pos][$key2];
		            }
		        if (isset($key3)){
		            $return_array[$pos][$key3] = $array[$pos][$key3];
		            }
		        if (isset($key4)){
		            $return_array[$pos][$key4] = $array[$pos][$key4];
		            }
		        if (isset($key5)){
		            $return_array[$pos][$key5] = $array[$pos][$key5];
		            }
		        if (isset($key6)){
		            $return_array[$pos][$key6] = $array[$pos][$key6];
		            }
		        }
		    return $return_array;
		}
		
}
