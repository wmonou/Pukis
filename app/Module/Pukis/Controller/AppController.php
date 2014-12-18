<?php

App::uses('Controller', 'Controller');
App::uses('PukisListener', 'Pukis.Event');
App::uses('PukisMenu', 'Pukis.Lib');

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
		'Time',
		'Pukis.Pukis',
		'Pukis.Table',
		'Pukis.Menu',
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
		'/Pukis/css/metis-menu/metis-menu.min.css',
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
		'/Pukis/js/metis-menu/metis-menu.min.js',
		'/Pukis/js/pukis/pukis.js'
	);
		
	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		
		// implemenet listener
		$this->getEventManager()->attach(new PukisListener());
		$this->getEventManager()->dispatch(new CakeEvent('Pukis.onSetupAdminData'));	

		$this->_authSetup();
		$this->_assetSetup();
		$this->_layoutSetup();
		$this->_menuSetup();
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
			'action' => 'admin_index',
			'admin' => true
		);
		
		$this->Auth->allow('ajaxRedirect');
	}
	
	/**
	 * Asset Setup
	 * 
	 * @access protected
	 */
	protected function _assetSetup() {
		$this->set('style', $this->style);
		$this->set('script', $this->script);
	}
	
	/**
	 * Layout Setup
	 * 
	 * @access protected
	 */
	protected function _layoutSetup() {
		if ($this->params['controller'] != 'pukis') {
			// $this->layout = "Pukis.pukis_admin";
			$this->layout = "Pukis.blank"; // debug mode
		} else {
			$this->layout = "Pukis.pukis";
		}
	}
	
	/**
	 * Menu Setup
	 * 
	 * @access protected
	 */
	protected function _menuSetup() {
		$sidebar = PukisMenu::$menu;
		$this->set('sidebar', $sidebar['sidebar']);
	}
	
	/**
	 * 
	 * @param unknown $url
	 * @param string $status
	 * @param string $exit
	 * 
	 * @access protected
	 */
	protected function ajaxRedirect($url, $status = null, $exit = true) {
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$data = array('url' => $url, 'status' => $status, 'exit' => $exit);
			print json_encode($data);
		} else {
			$this->redirect($url, $status = null, $exit = true);
		}
	}
	
}
