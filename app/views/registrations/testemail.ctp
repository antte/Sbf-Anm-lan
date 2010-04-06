<?php $myFile = "testFile.txt";
$fh = fopen($myFile, 'w');

$string = $this->renderElement('event');
$string .= $this->renderElement('registration');
$string .= $this->renderElement('person');
$string .= $this->renderElement('registrator');

fwrite($fh, strip_html_tags($string));

//fwrite($fh, strip_html_tags($this->renderElement('event')));
//fwrite($fh, strip_html_tags($this->renderElement('registration')));
//fwrite($fh, strip_html_tags($this->renderElement('person')));
//fwrite($fh, strip_html_tags($this->renderElement('registrator')));


	/**
	 * Remove HTML tags, including invisible text such as style and
	 * script code, and embedded objects.  Add line breaks around
	 * block-level tags to prevent word joining after tag removal.
	 */
	function strip_html_tags( $text )
	{
	    $text = preg_replace(
	        array(
	          // Remove invisible content
	            '/\n/',
	            '/\r/',
	            '/\t/',
	            '@<head[^>]*?>.*?</head>@siu',
	            '@<style[^>]*?>.*?</style>@siu',
	            '@<script[^>]*?.*?</script>@siu',
	            '@<object[^>]*?.*?</object>@siu',
	            '@<embed[^>]*?.*?</embed>@siu',
	            '@<applet[^>]*?.*?</applet>@siu',
	            '@<noframes[^>]*?.*?</noframes>@siu',
	            '@<noscript[^>]*?.*?</noscript>@siu',
	            '@<noembed[^>]*?.*?</noembed>@siu',
	            '@<th[^>]*?.*?</th>@siu',
	            // Add line breaks before and after blocks
	            '@</?((address)|(blockquote)|(center)|(del))@iu',
	            '@</?((/div)|(/h[1-9])|(/ins)|(/isindex)|(/p)|(/pre))@iu',
	            '@</?((/dir)|(/dl)|(/dt)|(/dd)|(/li)|(/menu)|(/ol)|(/ul))@iu',
	            '@</?((/table)|(/td)|(/caption))@iu',
	          	'@</?((/form)|(/button)|(/fieldset)|(/legend)|(input))@iu'
	          //'@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
	          //'@</?((frameset)|(frame)|(iframe))@iu',
	        ),
	        array(
	            '', '', "", '', '', '', '', '','','','','','',
	            "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0"
	        ),
	        $text );
	    return strip_tags( $text );
	}

fclose($fh);

?>