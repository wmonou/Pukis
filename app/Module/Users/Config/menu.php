<?php 
App::uses('PukisMenu', 'Pukis.Lib');

PukisMenu::add('sidebar', 'user', array(
	'title' => __d('users', 'Users'),
	'url' => '#',
	'icon' => 'fa fa-users',
	'children' => array(
		'users' => array(
			'title' => __d('users', 'Users'),
			'url' => array(
				'plugin' => 'users',
				'controller' => 'users',
				'action' => 'index',
				'admin' => true,
			),
			'icon' => 'fa fa-user'			
		),
		'permission' => array(
			'title' => __d('users', 'Permission'),
			'url' => array(
				'plugin' => 'users',
				'controller' => 'permissions',
				'action' => 'index',
				'admin' => true,				
			),
			'icon' => 'fa fa-unlock-alt'
		),
		'role' => array(
			'title' => __d('users', 'Role'),
			'url' => array(
				'plugin' => 'users',
				'controller' => 'roles',
				'action' => 'index',
				'admin' => true,
			),
			'icon' => 'fa fa-briefcase'
		),
	),
));