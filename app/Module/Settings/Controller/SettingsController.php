<?php

App::uses('SettingsAppController', 'Settings.Controller');

/**
 * SettingsController
 *
 * @category Controller
 * @package  Pukis.Settings.Controller
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
class SettingsController extends SettingsAppController 
{

	/**
	 * Model used in controllers
	 * 
	 * @var array uses
	 * @access public
	 */
	public $uses = array('Settings.Setting');
	
	/**
	 * Configuration interface
	 * @todo changing value trough this interface wont change anytingh
	 * it is only a feature to introduce the functionality to save settings on json
	 *
	 * @access public
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