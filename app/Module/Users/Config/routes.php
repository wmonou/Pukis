<?php 
/**
* Default routes
*/

Router::connect('/admin/users', array(
	'plugin' => 'users',
	'controller' => 'users', 
	'action' => 'index',
	'admin' => true
	));

Router::connect('/admin/users/login', array(
	'plugin' => 'users',
	'controller' => 'users',
	'action' => 'login',
	'admin' => true
));

Router::connect('/admin/users/logout', array(
	'plugin' => 'users',
	'controller' => 'users',
	'action' => 'logout',
	'admin' => true
));

Router::connect('/admin/roles', array(
	'plugin' => 'users',
	'controller' => 'roles', 
	'action' => 'index',
	'admin' => true
	));

Router::connect('/admin/permissions', array(
	'plugin' => 'users',
	'controller' => 'permissions', 
	'action' => 'index',
	'admin' => true
	));

Router::connect('/admin/permissions/change', array(
	'plugin' => 'users',
	'controller' => 'permissions', 
	'action' => 'change',
	'admin' => true
	));