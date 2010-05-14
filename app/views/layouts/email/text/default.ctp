<?php echo ($this->requestAction('admins/checkAdminLoggedIn'))? $this->element('email/messageForRegistrator') : '' ?>
<?php echo strip_html_tags($this->element('event'))?>
Du kan logga in med ditt bokningsnummer och email för att göra ändringar i din bokning på den här adressen: http://www.sbf.se/anmalan/registrations/login
Du kommer då få en ny faktura skickad till dig 
<?php echo strip_html_tags($this->element('registration'))?>
<?php echo strip_html_tags($this->element('registrator'))?>
<?php echo strip_html_tags($this->element('item'))?>
<?php echo strip_html_tags($this->element('invoice'));?>

<?php
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
	            //Remove table header it is impossible to make nice tables so the header is not needed
	            '@<th[^>]*?.*?</th>@siu',
	            // Add line breaks after blocks
	            '@</?((address)|(blockquote)|(center)|(del))@iu',
	            '@</?((/div)|(/h[1-9])|(/ins)|(/isindex)|(/p)|(/pre))@iu',
	            '@</?((/dir)|(/dl)|(/dt)|(/dd)|(/li)|(/menu)|(/ol)|(/ul))@iu',
	            '@</?((/table)|(/tr)|(/caption))@iu',
	            '@</?((/td))@iu',
	          	'@</?((/form)|(/button)|(/fieldset)|(/legend)|(input))@iu'
	          //'@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
	          //'@</?((frameset)|(frame)|(iframe))@iu',
	        ),
	        array(
	            '', '', "", '', '', '', '', '','','','','','',
	            "\n\$0", "\n\$0", "\n\$0", "\n\$0",', $0', "\n\$0"
	        ),
	        $text );
	    return strip_tags( $text );
	}
	
?>