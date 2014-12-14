<?php

App::uses('PukisAppController', 'Pukis.Controller');

/**
 * Pukis Controller
 *
 * @category Controller
 * @package  Pukis.Users.Controller
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
class PukisController extends PukisAppController {
	
	/**
	 * Before Filter
	 * 
	 * @see PukisAppController::beforeFilter()
	 */
	public function beforeFilter(){
		parent::beforeFilter();	
		$this->Auth->allow('index');	
	}
	
	/**
	 * landing page of no authentication
	 * 
	 * @access public
	 */
	public function index(){
		// empty page
		$user =  $this->Auth->user();
		if (!empty($user)){
			$this->ajaxRedirect('/admin/pukis');
		}
	}
	
	/**
	 * landing page of authentication
	 * 
	 * @access public
	 */
	public function admin_index(){
		// empty page
		$user =  $this->Auth->user();
		if (empty($user)){
			$this->ajaxRedirect('/admin/users/login');
		}
	}
	
}