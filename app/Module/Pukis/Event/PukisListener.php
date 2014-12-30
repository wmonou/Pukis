<?php

App::uses('CakeEventListener', 'Event');

/**
 * ExtensionsEventHandler
 *
 * @package  Pukis.Extensions.Event
 * @author   Rachman Chavik <rchavik@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
class PukisListener implements CakeEventListener {

	/**
	 * implementedEvents
	 */
	public function implementedEvents() {
		return array(
			'Pukis.onBeforeSetupAdminData' => array(
				'callable' => 'onBeforeSetupAdminData',
			),
			'Pukis.onSetupAdminData' => array(
				'callable' => 'onSetupAdminData',
			),
		);
	}

	/**
	 * Before Setup admin data
	 */
	public function onBeforeSetupAdminData($event) {
		$plugins = CakePlugin::loaded();
		$config = 'Config' . DS . 'admin.php';
		foreach ($plugins as $plugin) {
			$file = CakePlugin::path($plugin) . $config;
			if (file_exists($file)) {
				require $file;
			}
		}
	}

	/**
	 * Setup admin 
	 */
	public function onSetupAdminData($event) {
		$plugins = CakePlugin::loaded();
		$config = 'Config' . DS . 'menu.php';
		foreach ($plugins as $plugin) {
			$file = CakePlugin::path($plugin) . $config;
			if (file_exists($file)) {
				require $file;
			}
		}
	}

}