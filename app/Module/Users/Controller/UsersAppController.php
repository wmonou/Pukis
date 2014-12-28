<?php

App::uses('AppController', 'Pukis.Controller');

/**
 * UsersAppController
 *
 * @category Controller
 * @package  Module.Users.Controller
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
class UsersAppController extends AppController
{

	/**
	 * Settings for paginate
	 * @var array
	 **/
	public $paginate = array(
		"limit" => 10
		);

	/**
	 * Helpers used
	 * @var array
	 **/
	public $helpers = array(
		'Session',
		'Js',
		'Html',
		'Form'
	);

	/**
	 * Components used
	 * @var array
	 **/
	public $components = array(
		'Auth',
		'Session',
		'Paginator'
	);
	
	/**
	 * Called before actions
	 * @see Controller::beforeFilter()
	 * @access public
	 */
	public function beforeFilter()
	{
		parent::beforeFilter();

		if ( ( $settings = Cache::read('settings', "users") ) === false ) {
			 $settings = ClassRegistry::init('Users.Setting')->find('all');
			 Cache::write('settings', $settings, "users");
		}
		
		foreach( $settings AS $setting )
		{
			Configure::write('Config.'.$setting['Setting']['setting'], $setting['Setting']['value']);
		}
		
		$this->Cookie->key = 'qSI23ATYH2qs*&sXOw!adre@FUCKIT!KJ34SAv!@*(XSL#$%)asGb$@11IAJL:+!@#HKis~#^';
		$this->Cookie->httpOnly = true;
		if (!$this->_checkRememberMe()) {
			$this->ajaxRedirect('/admin/users/logout');
		}
	}
	
	/**
	 * Check remember me cookies
	 * @return boolean
	 * @access public
	 */
	private function _checkRememberMe() 
	{
		if (!$this->Auth->loggedIn() && $this->Cookie->read('Pukis.token')) {

			$cookie = $this->Cookie->read('Pukis.token');
			
			$user = $this->User->find('first', array(
				'conditions' => array(
					'User.username' => $cookie['username'],
					'User.password' => $cookie['password']
				)
			));
			
			if ($user && !$this->Auth->login($user['User'])) {
				$this->Cookie->delete('token');
				return false; 
			}			
		}
		
		return true;
	}
}

 ?>