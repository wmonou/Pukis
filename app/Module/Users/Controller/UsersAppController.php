<?php

/**
 * UsersAppController
 *
 * @category Controller
 * @package  Module.User.Controller
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://akemis.kodehive.com
 */
App::uses('AppController', 'Pukis.Controller');

class UsersAppController extends AppController{

	/**
	 * Settings for paginate
	 *
	 * @var array
	 **/
	public $paginate = array(
		"limit" => 10
		);

	/**
	 * Helpers
	 *
	 * @var array
	 **/
	public $helpers = array(
		'Session',
		'Js',
		'Html',
		'Form'
	);

	/**
	 * Components
	 *
	 * @var array
	 **/
	public $components = array(
		'Auth',
		'Session',
		'Paginator'
	);

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
	}
}

 ?>