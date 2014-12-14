<?php

Router::connect('/', array(
	'plugin' => 'pukis',
	'controller' => 'pukis',
	'action' => 'index',
	'admin' => false
	));
	
Router::connect('/admin/pukis/*', array(
	'plugin' => 'pukis',
	'controller' => 'pukis',
	'action' => 'admin_index',
	'admin' => true
));
