<?php
class RandomHelperComponent extends Object {
 
/**
 * Random string generator function
 *
 * This function will randomly generate a string from a given set of characters
 *
 * @param int = 6, length of the password you want to generate
 * @param string = 0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ all possible values
 * @return string, the password
 */     
	function generateRandomString ($length = 6, $possible = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ') {
		// initialize variables
		$string = "";
		$i = 0;
 
		// add random characters to $string until $length is reached
		while ($i < $length) {
			// pick a random character from the possible ones
			$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
 
			// we don't want this character if it's already in the string
			if (!strstr($string, $char)) { 
				$string .= $char;
				$i++;
			}
		}
		return $string;
	}
}
?>