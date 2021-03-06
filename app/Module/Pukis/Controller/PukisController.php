<?php

App::uses('PukisAppController', 'Pukis.Controller');

/**
 * Pukis Controller
 *
 * @category Controller
 * @package  Pukis.Pukis.Controller
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
class PukisController extends PukisAppController 
{
	/**
	 * Helpers used by controller
	 * @var array
	 * @access public
	 */
	public $helpers = array('Pukis.Menu');
	
	/**
	 * Before Filter
	 * @see PukisAppController::beforeFilter()
	 * @access public
	 */
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('index', 'message');
	}
	
	/**
	 * Landing page of no authentication
	 * @access public
	 */
	public function index()
	{
		// empty page
		if ($this->Auth->loggedIn()) {
			$this->ajaxRedirect('/admin/pukis');
		}
	}
	
	/**
	 * Landing page of authentication
	 * @access public
	 */
	public function admin_index()
	{
		// empty page
		if (!$this->Auth->loggedIn()) {
			$this->ajaxRedirect('/admin/users/login');
		}
		
	}
	
}