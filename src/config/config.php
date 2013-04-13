<?php

return array(
	
	/*
	|----------------------------------------------------------------------
	| Default Driver
	|----------------------------------------------------------------------
	|
	| Set default driver for Orchestra\Memory.
	|
	*/

	'driver' => 'fluent.default',

	/*
	|----------------------------------------------------------------------
	| Cache configuration
	|----------------------------------------------------------------------
	*/
	
	'cache'  => array(),
	
	/*
	|----------------------------------------------------------------------
	| Eloquent configuration
	|----------------------------------------------------------------------
	*/

	'eloquent' => array(
		'default' => array(
			'model' => '\Orchestra\Memory\Model',
		),
	),
	
	/*
	|----------------------------------------------------------------------
	| Fluent configuration
	|----------------------------------------------------------------------
	*/

	'fluent' => array(
		'default' => array(
			'table' => 'orchestra_options',
		),
	),

	/*
	|----------------------------------------------------------------------
	| Runtime configuration
	|----------------------------------------------------------------------
	*/

	'runtime' => array(),
);