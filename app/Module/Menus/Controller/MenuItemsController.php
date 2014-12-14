<?php
App::uses('MenusAppController', 'Menus.Controller');
/**
 * MenuItems Controller
 *
 */
class MenuItemsController extends MenusAppController {

/**
	 * Controller name
	 * 
	 * @var string
	 * @access public
	 */
	public $name = 'Menuitems';
	
	/**
	 * Models used by controller
	 * 
	 * @var array
	 * @access public
	 */
	public $uses = array('Menus.Menu', 'Menus.MenuItems');
	
	/**
	 * Controller constructor
	 * @see Controller::beforeFilter()
	 * 
	 * @access public
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('');
	}
	
	/**
	 * List Menu
	 * 
	 * @param string $menuId
	 * @access public
	 */
	public function admin_index($menuId = null) {
		if (!$menuId) {
			$this->Session->setFlash(__d('menus', "Invalid ID"), 'flash_error');
			$this->ajaxRedirect('/admin/menus/menus/index');
		}
		$menuData = $this->Menu->find('all', array('id' => $menuId));
		$this->set('menuData', $menuData);
	}
	
	/**
	 * Create menu
	 * 
	 * @access public
	 */
	public function admin_add($menuId = null) {
		if (!$menuId) {
			$this->Session->setFlash(__d('menus', "Invalid ID"), 'flash_error');
			$this->ajaxRedirect('/admin/menus/menus/index');
		} else {
			$this->request->data['MenuItem']['menu_id'] = $menuId;
		}
		if (!empty($this->request->data)) {
			$this->Menu->create();
			if ($this->MenuItem->save($this->request->data)) {
				$this->Session->setFlash(__d('menus', 'Role created.'), 'flash_success');
				$this->ajaxRedirect('/admin/menus/menuitems/index/' . $menuId);
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
			if  ($this->Role->save( $this->request->data)) {
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
	public function detele($id = null) {
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
