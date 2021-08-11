<?php
/* Include Classes (When needed)*/
spl_autoload_register( function($class)	{
	switch ($class) {
		case 'CoreFunctions':
			require_once 'classes/core-function.class.php';
			break;
	}
});