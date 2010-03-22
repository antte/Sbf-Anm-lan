<?php
	class FallbackComponent extends Object {
	    function startup(&$controller)
	    {
	        $allowed_methods = get_class_methods($controller);
	        if (!$allowed_methods) $allowed_methods = array();
	        if (!in_array($controller->action, $allowed_methods))
	        {
	            if (isset($controller->defaultAction) && method_exists($controller, $controller->defaultAction))
	            {
	                echo $controller->{$controller->defaultAction}();
	                exit(); // To prevent double rendering
	            }
	        }
	
	    }
	} 