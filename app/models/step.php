<?php
	class Step extends AppModel {
		var $hasAndBelongsToMany = "Event";
		
		
	function rocketData($eventId){
		$steps = $this->Event->findById($eventId);
		$steps = $steps['Step'];
		$rocket = array();
		foreach($steps as $i => $step) {
				
			$label 		= $step['name'];
			$controller = $step['controller'];
			$action 	= $step['action'];
			$order 		= $step['EventsStep']['order'];
			$key		= $controller .'/'. $action;
			
			// controller  = plural
			//$controller = Inflector::singularize($controller);
			// controller = singular
			$rocket[$key]['label'] = $label;
			if ($i==0){
				$rocket[$key]['state'] = 'current';
			} else {
				$rocket[$key]['state'] = 'comming';
			}
			$rocket[$key]['controller'] = strtolower(Inflector::pluralize($controller));
			$rocket[$key]['action'] = $action;
			$rocket[$key]['order']= $order; 
		}	
		$rocket = $this->multisort($rocket,'order','label','action', 'controller','state');
		return $rocket;	
	}		
		
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
			
			/*$steps = array(
			'Person' => array(
				'current_step' => true,
				'label' => 'Sällskap',
			),
			'Registrator' => array(
				'current_step' => false,
				'label' => 'Kontaktuppgifter',
			),
			'Review' => array(
				'current_step' => false,
				'label' => 'Granska',
			),
			'Receipt'=> array(
				'current_step' => false,
				'label' => 'Kvitto',
			)
		);
		}
		*/
	}
}