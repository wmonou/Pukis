<?php

App::uses('Controller', 'Controller');

/**
 * User
 *
 * @category Controller
 * @package  Module.Pukis.Controller
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://akemis.kodehive.com
 */
class AppController extends Controller {
	
	/**
	 * Core Components
	 * 
	 * @var array
	 * @access public
	 */
	public $components = array (
		'Acl',
		'Auth',
		'Cookie',
		'Session',
		'RequestHandler'
	);
	
	/**
	 * Helper
	 *
	 * @var arrary
	 * @access public
	*/
	public $helpers = array (
		'Form',
		'Html',
		'Js',
		'Paginator',
		'Session',
		'Text',
		'Time'
	);
		
	/**
	 * Model Use
	 * 
	 * @var array
	 * @access public
	 */
	public $uses = array ();
	
	/**
	 * Layout Use
	 * 
	 * @var String
	 * @access public
	 */
	public $layout = 'Pukis.pukis';
	
	/**
	 * Style Use
	 * 
	 * @var style
	 * @access public
	 */
	public $style = array(
		'/Pukis/css/bootstrap/bootstrap.min.css',
		'/Pukis/css/font-awesome/font-awesome.min.css',
		'/Pukis/css/pukis/pukis.css'		
	);
	
	/**
	 * Script Use
	 *
	 * @var style
	 */
	public $script = array(
		'/Pukis/js/jquery/jquery.min.js',
		'/Pukis/js/jquery/jquery.easyModal.js',
		'/Pukis/js/bootstrap/bootstrap.min.js',
		'/Pukis/js/pukis/pukis.js'
	);
		
	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function beforeFilter() {
		
		parent::beforeFilter();
		$this->_authSetup();
		$this->_assetSetup();
	}
	
	/**
	 * Configure AuthComponent
	 * 
	 * @access protected
	 */
	protected function _authSetup() {
		$this->Auth->authenticate = array(
			'Form' => array(
				'fields' => array(
					'username' => 'username',
					'password' => 'password'
				)
			)
		);
		
		$this->Auth->loginAction = array(
			'plugin' => 'users',
			'controller' => 'users',
			'action' => 'login',
			'admin' => true
		);
		
		$this->Auth->logoutRedirect = array(
			'plugin' => 'users',
			'controller' => 'users',
			'action' => 'logout',
			'admin' => true
		);
		
		$this->Auth->loginRedirect = array(
			'plugin' => 'pukis',
			'controller' => 'pukis',
			'action' => 'index',
			'admin' => false
		);
	}
	
	/**
	 * @access protected
	 */
	protected function _assetSetup() {
		if ($this->plugin != 'Pukis') {
			if (file_exists(APP . 'Module' . DS . 'Module' . DS . $this->plugin . DS . 'webroot' . DS .'css' . DS . strtolower($this->plugin) . 'css')) {
				$this->script[] = $this->plugin . DS . 'css' . DS . strtolower($this->plugin) . 'css';
			}
			
			if (file_exists(APP . 'Module' . DS . 'Module' . DS . $this->plugin . DS . 'webroot' . DS .'css' . DS . strtolower($this->plugin) . 'js')) {
				$this->script[] = $this->plugin . DS . 'css' . DS . strtolower($this->plugin) . 'js';
			}
		}
		
		$this->set('style', $this->style);
		$this->set('script', $this->script);
	}
	
	/**
	 * 
	 * @param unknown $url
	 * @param string $status
	 * @param string $exit
	 * 
	 * @access protected
	 */
	public function ajaxRedirect($url, $status = null, $exit = true) {
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$data = array('url' => $url, 'status' => $status, 'exit' => $exit);
			print json_encode($data);
		} else {
			$this->redirect($url, $status = null, $exit = true);
		}
	}
	
}
