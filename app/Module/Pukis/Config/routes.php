<?php

Router::connect('/', array(
	'plugin' => 'pukis',
	'controller' => 'pukis',
	'action' => 'index',
	'admin' => false
	));
	
	