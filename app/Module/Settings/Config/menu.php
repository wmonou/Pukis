<?php 
App::uses('PukisMenu', 'Pukis.Lib');

PukisMenu::add('sidebar', 'settings', array(
	'title' => __d('settings', 'Settings'),
	'url' => '#',
	'icon' => 'fa fa-gear',
	'children' => array(
		'fork' => array(
			'title' => __d('settings', 'Config'),
			'url' => array(
				'plugin' => 'settings',
				'controller' => 'settings',
				'action' => 'edit',
				'admin' => true,
				'key' => 'Site'
				),
			'icon' => 'fa fa-check-square-o'
			),
		),
	));
