<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array_replace_recursive(
    require dirname(__FILE__).'/static/console.php',
	
	array(
		'import'=>array(
			'application.models.*',
		),
	)
);