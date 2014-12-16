<?php 

/**
 * Settings
 */

App::uses('Wmonou', 'Vendor');

// long
Cache::config('default', array(
	    'engine' => 'Memcached',
	    'duration' => 3600,
	    'probability' => 100,
	    'path' => CACHE . 'long' . DS,
	));

App::uses('PukisJsonReader', 'Pukis.Configure');
Configure::config('settings', new PukisJsonReader(APP . 'Module' . DS . 'Pukis' . DS . 'Config' . DS));
if (file_exists(APP . 'Module' . DS . 'Pukis' . DS . 'Config' . DS . 'settings.json')) {
	Configure::load('settings', 'settings');	
}

CakePlugin::loadAll(
	array('Users' => array('bootstrap' => true, 'routes' => true))
);

?>