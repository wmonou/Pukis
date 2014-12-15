<?php
App::uses('MenusAppController', 'Menus.Controller');

/**
 * User
 *
 * @category Controller
 * @package  Module.Menus.Controller
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
class MenusController extends MenusAppController {

	/**
	 * Controller name
	 * 
	 * @var string
	 * @access public
	 */
	public $name = 'Menus';
	
	/**
	 * Models used by controller
	 * 
	 * @var array
	 * @access public
	 */
	public $uses = array('Menus.Menu');
	
	/**
	 * Components used by controller
	 * 
	 * @var array $components
	 * @access public
	 */
	public $components = array('Pukis.DataTables');
	
	/**
	 * Controller constructor
	 * @see Controller::beforeFilter()
	 * 
	 * @access public
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}
	
	/**
	 * List Menu
	 * 
	 * @access public
	 */
	public function admin_index() {
		// get view
		if(!empty($this->request->data)){
			$this->autoRender = false;
			print json_encode($this->DataTables->getResponse());			
		}
	}
	
	/**
	 * List Data
	 *
	 * @access public
	 */
	public function admin_data() {
		$this->autoRender = false;
		if(!empty($this->request->data)){
			print json_encode($this->DataTables->getResponse());			
		}
	}
	
	/**
	 * Create menu
	 * 
	 *  @access public
	 */
	public function admin_add() {
		if (!empty($this->request->data)) {
			$this->Menu->create();
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash(__d('menus', 'Role created.'), 'flash_success');
				$this->ajaxRedirect('/admin/menus/menus/index');
			}
		}
	}
	
	/**
	 * Edit menu
	 * 
	 * @param string $id
	 * @access public
	 */
	public function admin_edit($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('menus', "Invalid ID"), 'flash_error');
			$this->ajaxRedirect('/admin/menus/menus/index');
		}
		if ( !empty( $this->request->data )) {
			if  ($this->Menu->save( $this->request->data)) {
				$this->Session->setFlash(__d('menus', "The Role was saved."), 'flash_success');
				$this->redirect('/admin/menus/menus/index');
			}
		}
		$this->request->data = $this->Role->read(null, $id);
	}
	
	/**
	 * Delete Menu
	 * 
	 * @param string $id
	 * @access public
	 */
	public function admin_detele($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('menus', 'Invalid ID.'), 'flash_error');
			$this->ajaxRedirect(array('action' => 'index'));
		}
		if( $this->Menu->delete($id)){
			$this->Session->setFlash(__d('menus', 'The user was deleted.'), 'flash_success');
			$this->redirect(array('action' => 'index'));
		}
	}

}
