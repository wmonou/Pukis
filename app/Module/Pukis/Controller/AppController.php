<?php

App::uses('Controller', 'Controller');
App::uses('PukisListener', 'Pukis.Event');
App::uses('PukisMenu', 'Pukis.Lib');

/**
 * AppController
 *
 * @category Controller
 * @package  Module.Pukis.Controller
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
class AppController extends Controller 
{
	
	/**
	 * Core Components
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
	 * Helper used in this controller
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
	 * Model used in this controller
	 * @var array
	 * @access public
	 */
	public $uses = array ();
	
	/**
	 * Layout used in this controller
	 * @var String
	 * @access public
	 */
	public $layout = 'Pukis.pukis';
	
	/**
	 * Style used in this controller
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
	 * Script used in this controller
	 * @var style
	 * @access public
	 */
	public $script = array(
		'/Pukis/js/jquery/jquery.min.js',
		'/Pukis/js/jquery/jquery-ui.min.js',
		'/Pukis/js/jquery/jquery.easyModal.js',
		'/Pukis/js/bootstrap/bootstrap.min.js',
		'/Pukis/js/metis-menu/metis-menu.min.js',
		'/Pukis/js/pukis/pukis.js'
	);
		
	/**
	 * Constructor
	 * @access public
	 */
	public function beforeFilter() 
	{
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
	 * @access protected
	 */
	protected function _authSetup() 
	{
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
			'plugin' => 'pukis',
			'controller' => 'pukis',
			'action' => 'index',
			'admin' => false
		);
		
		$this->Auth->loginRedirect = array(
			'plugin' => 'pukis',
			'controller' => 'pukis',
			'action' => 'index',
			'admin' => true
		);
		
		$this->Auth->allow('ajaxRedirect', 'ajaxMessage');
		
		if ($this->Auth->loggedIn()) {
			$this->set('authUserId', $this->Auth->user('id'));
		}
	}
	
	/**
	 * Assets Setup
	 * @access protected
	 */
	protected function _assetSetup() 
	{
		$this->set('style', $this->style);
		$this->set('script', $this->script);
	}
	
	/**
	 * Layout Setup
	 * @access protected
	 */
	protected function _layoutSetup() 
	{
		if ($this->params['controller'] != 'pukis' && $this->params['action'] != 'admin_login') {
			 $this->layout = "Pukis.pukis_admin";
			//$this->layout = "Pukis.blank"; // debug mode
		} else {
			$this->layout = "Pukis.pukis";
		}
	}
	
	/**
	 * Menu Setup
	 * @access protected
	 */
	protected function _menuSetup() 
	{
		$sidebar = PukisMenu::$menu;
		$this->set('sidebar', $sidebar['sidebar']);
	}
	
	/**
	 * @param unknown $url
	 * @param string $status
	 * @param string $exit
	 * @access protected
	 */
	protected function ajaxRedirect($url, $status = null, $exit = true) 
	{
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$url = Router::normalize($url);
			$data = array('url' => $url, 'status' => $status, 'exit' => $exit);
			print json_encode($data);
		} else {
			$this->redirect($url, $status = null, $exit = true);
		}
		if ($exit)
			exit;
	}

}