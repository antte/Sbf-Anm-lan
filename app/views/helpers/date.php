<?php
	class DateHelper extends Helper {
		
		function SE($dateInput, $onlyDate = false){
			if($onlyDate == false){
				$dateInput = date("l j F h:i:s", strtotime($dateInput));
			} else {
				$dateInput = date("l j F", strtotime($dateInput));
			}
			
			$date = array(
				"/January/", "/February/", "/March/", "/May/", "/June/", "/July/", "/August/", "/October/",
				"/May/", "/Oct/",
				"/Monday/", "/Tuesday/", "/Wednesday/", "/Thursday/", "/Friday/", "/Saturday/", "/Sunday/",
				"/Mon/", "/Tue/", "/Wed/", "/Thu/", "/Fri/", "/Sat/", "/Sun/"
			);
			$dateSE = array(
				"Januari", "Februari", "Mars", "Maj", "Juni", "Juli", "Augusti", "Oktober",
				"Maj", "Okt",
				"Måndag", "Tisdag", "Onsdag", "Torsdag", "Fredag", "Lördag", "Söndag",
				"Mån", "Tis", "Ons", "Tor", "Fre", "Lör", "Sön"
			);
			return preg_replace($date, $dateSE, $dateInput);
		}
		
	
	}