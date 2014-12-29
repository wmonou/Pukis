<?php
App::uses('PukisMenu', 'Pukis.Lib');

PukisMenu::add('sidebar', 'pukis', array(
	'title' => __d('pukis', 'Pukis Repository'),
	'url' => '#',
	'icon' => 'fa fa-github',
	'children' => array(
		'fork' => array(
			'title' => __d('pukis', 'Fork'),
			'url' => 'https://github.com/wmonou/Pukis',
			'icon' => 'fa fa-code-fork',
			'target' => 'new'
		),
		'star' => array(
			'title' => __d('pukis', 'Star'),
			'url' => 'https://github.com/wmonou/Pukis',
			'icon' => 'fa fa-star',
			'target' => 'new'
		),
		'download' => array(
			'title' => __d('pukis', 'Star'),
			'url' => 'https://github.com/wmonou/Pukis',
			'icon' => 'fa fa-cloud-download',
			'target' => 'new'
		),
	),
));