<?php

App::uses('UsersAppController', 'Users.Controller');

/**
 * RolesController
 *
 * @category Controller
 * @package  Module.Users.Controller
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
class RolesController extends UsersAppController
{
	
	/**
	 * Controller callback
	 * @return void
	 * @access public
	 */
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->set('title_for_layout', __d('admin', 'Roles'));
	}
	
	/**
	 * admin_index - show all roles
	 * @return void
	 * @access public
	 */
	public function admin_index()
	{
		$this->paginate['Role']['order'] = 'Role.id Desc';
		$this->set('roles', $this->paginate('Role'));
	}
	
	/**
	 * admin_add - add new roles
	 * @return void
	 * @access public
	 */
	public function admin_add()
	{
		if (!empty( $this->request->data)) {
			$this->Role->create();
			if ( $this->Role->save( $this->request->data ) ) {
				$this->Session->setFlash(__d('admin', 'Role created.'), 'flash_success', array('plugin' => 'Pukis'));
				$this->ajaxRedirect('/admin/users/roles/index');
			}
			
			$this->Session->setFlash(__d('users', 'Unknown error occured!'), 'flash_error', array('plugin' => 'Pukis'));
			$this->ajaxRedirect('/admin/users/roles/index');
		}
	}
	
	/**
	 * admin_edit - edit existing roles name
	 * @param $id Role id
	 * @return void
	 * @access public
	 */
	public function admin_edit( $id = null )
	{
		if( !$id ) {
			$this->Session->setFlash(__d('admin', "Invalid ID"), 'flash_error');
			$this->ajaxRedirect(array("action" => 'index'));			
		} 
		
		if( !empty( $this->request->data ) ) {
			if( $this->Role->save( $this->request->data ) )
			{
				$this->Session->setFlash(__d('admin', "The Role was saved."), 'flash_success', array('plugin' => 'Pukis'));
				$this->ajaxRedirect('/admin/users/roles/index');
			}
			
			$this->Session->setFlash(__d('users', 'Unknown error occured!'), 'flash_error', array('plugin' => 'Pukis'));
			$this->ajaxRedirect('/admin/users/roles/index');
		}
		
		$this->request->data = $this->Role->read(null, $id);
	}
	
	/**
	 * admin_delete - delete roles
	 * @param  $id Role id
	 * @return void
	 * @access public
	 */
	public function admin_delete($id = null, $confirm = 0)
	{
		if (!$id) {
			$this->Session->setFlash(__d('admin', 'Invalid ID.'), 'flash_error');
			$this->ajaxRedirect(array('action' => 'index'));
		}
				
		if($confirm == 1) {
			if ($this->Role->delete($id)) {
				$this->Session->setFlash(__d('admin', 'The role was deleted.'), 'flash_success', array('plugin' => 'Pukis'));
				$this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__d('users', 'Unknown error occured!'), 'flash_error', array('plugin' => 'Pukis'));
			$this->ajaxRedirect('/admin/users/roles/index');
		}
		
		$key = 'id';
		$this->set(compact('key', 'id'));
	}
}