<?php 
App::uses('PukisMenu', 'Pukis.Lib');

PukisMenu::add('sidebar', 'pukis', array(
	'title' => __d('pukis', 'Pukis Repository'),
	'url' => '#',
	'icon' => 'fa fa-github',
	'children' => array(
		'fork' => array(
			'title' => __d('pukis', 'Fork'),
			'url' => '#',
			'icon' => 'fa fa-code-fork'
		),
		'star' => array(
			'title' => __d('pukis', 'Star'),
			'url' => '#',
			'icon' => 'fa fa-star'
		),
		'download' => array(
			'title' => __d('pukis', 'Star'),
			'url' => '#',
			'icon' => 'fa fa-cloud-download'
		),
	),
));