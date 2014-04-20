<?php

	global $debug;
	$debug->startUsedTime('routing');

	// include class
	include_once('class.sparky.routing.php');

	// create routing class
	$routing = new Routing;
	
	// install routing
	$routing->enableRouting();
	
	// get actual route
	$routing->showRoute();

	$debug->endUsedTime('routing');
	
?>