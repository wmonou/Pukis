<?php 
App::uses('PukisJsonReader', 'Pukis.Configure');

/**
 * Setting
 *
 * @category Model
 * @package  Module.Settings.Model
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
class Setting  {
	
	/**
	 * 
	 * @var unknown
	 */
	public $useTable = false;

	/**
	 * 
	 * @param unknown $key
	 * @return mixed
	 */
	public function find($key) 
	{
		if ($key == 'all') {
			$this->Config = new PukisJsonReader(APP . 'Module' . DS . 'Pukis' . DS . 'Config' . DS);
			return  $this->Config->read('settings');
		} 
		
		return Configure::read($key);				
	}

	/**
	 * 
	 * @param unknown $data
	 */
	public function save($data) 
	{
		$this->Config = new PukisJsonReader(APP . 'Module' . DS . 'Pukis' . DS . 'Config' . DS);
		
		if (file_exists(APP . 'Module' . DS . 'Pukis' . DS . 'Config' . DS . 'settings.json')) {
			$file = 'settings.json';
			$settings = $this->Config->read('settings');
		}
		
		// save configuration to settings.json
		$settings = Hash::merge($settings, $data);
		$this->Config->dump($file, $settings);
		
		// write over application configuration from settings.json
		Configure::config('settings', new PukisJsonReader(APP . 'Module' . DS . 'Pukis' . DS . 'Config' . DS));
		if (file_exists(APP . 'Module' . DS . 'Pukis' . DS . 'Config' . DS . 'settings.json')) {
			Configure::load('settings', 'settings');
		}		
	}
	
	

	
}