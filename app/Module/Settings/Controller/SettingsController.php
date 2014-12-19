<?php
App::uses('SettingsAppController', 'Settings.Controller');

/**
 * Settings Controller
 *
 */
class SettingsController extends SettingsAppController {

	/**
	 * 
	 * @var unknown
	 */
	public $uses = array('Settings.Setting');
	
	/**
	 * Scaffold
	 *
	 * @var mixed
	 */
	public function admin_edit()
	{
		if(isset($this->params['named']['key']) && ($this->params['named']['key'] != null))
			$key = $this->params['named']['key'];
		else
			$key = 'Site';
		
		if(!empty($this->request->data)) {
			$this->Setting->save($this->request->data);
		}
				
		$configs = $this->Setting->find($key);
		$this->set(compact('key', 'configs'));
	}

}
