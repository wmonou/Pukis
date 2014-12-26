<?php

/**
 * UsersController
 *
 * @category Controller
 * @package  Module.Users.Controller
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
App::uses('UsersAppController', 'Users.Controller');

class UsersController extends UsersAppController
{
	/**
	 * Models
	 *
	 * @var array
	 **/
	public $uses = array('Users.User', 'Users.Role', 'User.Login');

	/**
	 * Controller callback - beforeFilter()
	 * 
	 * @return void
	 */
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('admin_login');
	}
	
	/**
	 * Index
	 * 
	 * @return void
	 */
	public function admin_index()
	{
		$this->paginate['User']['order'] = 'User.id Desc';
		$this->set('users', $this->paginate('User'));
	}
	
	/**
	 * User Add
	 * 
	 * @return void
	 */
	public function admin_add()
	{
		if ( !empty( $this->request->data ) ) {
			$this->User->create();			
			if ( $this->User->save( $this->request->data ) ) {
				$this->Session->setFlash(__d('users', 'User saved.'), 'flash_success', array('plugin' => 'Pukis'));
				$this->ajaxRedirect('/admin/users/users/index');
			}
		}
		$roles = $this->Role->find('list', array('conditions' => "Role.id >= '". $this->Auth->user('role_id') ."'"));
		$this->set(compact('roles'));
	}
	
	/**
	 * User Edit
	 * 
	 * @param $id User ID
	 * @return void
	 */
	public function admin_edit( $id = null )
	{
		if ( !$id ) {
			$this->Session->setFlash(__d('users', 'Invalid ID'), 'flash_error', array('plugin' => 'Pukis'));
			$this->redirect(array('action' => 'index'));
		}
		
		$editedUser = $this->User->find('first', array('conditions' => array('id' => $id), 'contain' => false));
		
		if ($this->Auth->user('id') != $id) {
			if ($this->Auth->user('role_id') >= $editedUser['User']['role_id']) {
				$this->Session->setFlash(__d('users', 'Cannot edit your own or upper class!'), 'flash_error', array('plugin' => 'Pukis'));
				$this->ajaxRedirect('/admin/users/users/index');
			}
		}
		
		if ( !empty( $this->request->data ) ) {
			if ( $this->User->save($this->request->data) ) {
				$this->Session->setFlash(__d('users', 'User was saved.'), 'flash_success', array('plugin' => 'Pukis'));
				$this->ajaxRedirect('/admin/users/users/index');
			}
			
			$this->Session->setFlash(__d('users', 'Unknown error occured!'), 'flash_error', array('plugin' => 'Pukis'));
			$this->ajaxRedirect('/admin/users/users/index');
		}
		
		$this->request->data = $editedUser;
		$roles = $this->Role->find('list', array('conditions' => "Role.id >= '". $this->Auth->user('role_id') ."'"));
		$this->set(compact('roles'));
	}
	
	/**
	 * Login
	 * 
	 * @return void
	 */
	public function admin_login()
	{
		
		if ($this->Auth->loggedIn()) {
			$this->Session->setFlash(__d('users', 'You are still have login'), 'flash_info', array('plugin' => 'Pukis'));
			return $this->ajaxRedirect($this->Auth->redirect());
		}
		
		if ( $this->request->is('post') ) {
			if ($this->Auth->login()) {
				// did they select the remember me checkbox?
				if ($this->request->data['User']['remember_me'] == 1) {
					unset($this->request->data['User']['remember_me']);
    	            $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
	                // write the cookie
                	$this->Cookie->write('Pukis.token', $this->request->data['User'], true, Configure::read('AuthAccess.duration'));                	
				}
				
				$this->Session->setFlash(__d('users', 'Login Success'), 'flash_success', array('plugin' => 'Pukis'));
				return $this->ajaxRedirect($this->Auth->redirect());
			}
			
			$this->Session->setFlash(__d('users', 'Login Error'), 'flash_error', array('plugin' => 'Pukis'));
			return $this->ajaxRedirect($this->Auth->redirect());
		}
	}
	
	/**
	 * Logout
	 * 
	 * @return void
	 */
	public function admin_logout()
	{
		if ($this->Auth->logout()) {
			$this->Session->setFlash(__d('users', 'Logout Success'), 'flash_success', array('plugin' => 'Pukis'));
			return $this->ajaxRedirect($this->Auth->redirect());
		}
		
		$this->Session->setFlash(__d('users', 'Unknown error occured!'), 'flash_error', array('plugin' => 'Pukis'));
		$this->ajaxRedirect('/admin/users/users/index');
	}
	
	/**
	 * Reset Password
	 * 
	 * @param  $id User ID
	 * @return void
	 */
	public function admin_change_password($id = null)
	{
		if ( !$id ) {
			$this->Session->setFlash(__d('users', 'Invalid ID'), 'flash_error', array('plugin' => 'Pukis'));
			$this->redirect(array('action' => 'index'));
		}
		
		if ( !empty( $this->request->data ) ) {
			if ( $this->User->save($this->request->data) ) {
				$this->Session->setFlash(__d('users', 'password was saved.'), 'flash_success', array('plugin' => 'Pukis'));
				$this->ajaxRedirect('/admin/users/users/index');
			}
			
			$this->Session->setFlash(__d('users', 'Unknown error occured!'), 'flash_error', array('plugin' => 'Pukis'));
			$this->ajaxRedirect('/admin/users/users/index');
		}
	}
	
	/**
	 * Delete User
	 * 
	 * @param $id User ID
	 * @return void
	 */
	public function admin_delete($id = null, $confirm = 0)
	{	
		if (!$id) {
			$this->Session->setFlash(__d('users', 'Invalid ID!'), 'flash_error', array('plugin' => 'Pukis'));
			$this->ajaxRedirect('/admin/users/users/index');
		}
		
		if ($this->Auth->user('id') == $id) {
			$this->Session->setFlash(__d('users', 'Cannot delete your own Id!'), 'flash_error', array('plugin' => 'Pukis'));
			$this->ajaxRedirect('/admin/users/users/index');
		}
		
		$deletedUser = $this->User->find('first',array('conditions' => array('id' => $id), 'contain' => false));
		if ($this->Auth->user('role_id') >= $deletedUser['User']['role_id']) {
			$this->Session->setFlash(__d('users', 'Cannot delete your own or upper class!'), 'flash_error', array('plugin' => 'Pukis'));
			$this->ajaxRedirect('/admin/users/users/index');
		}
		
		if($confirm == 1) {
			if ( $this->User->delete($id) ) {
				$this->Session->setFlash(__d('users', 'User was deleted.'), 'flash_success', array('plugin' => 'Pukis'));
				$this->ajaxRedirect('/admin/users/users/index');	
			}
			
			$this->Session->setFlash(__d('users', 'Unknown error occured!'), 'flash_error', array('plugin' => 'Pukis'));
			$this->ajaxRedirect('/admin/users/users/index');
		}
		
		$key = 'id';
		$this->set(compact('key', 'id'));
	}
	
	/**
	 *  Install
	 */
	public function admin_install()
	{
		$this->AclAco->create(array('parent_id' => null, 'alias' => 'controllers'));
		$this->AclAco->save();
		
		$this->Session->setFlash(__d('users', 'AclAco has been created'), 'flash_success', array('plugin' => 'Pukis'));
		$this->ajaxRedirect('/admin/users/users/index');	
	}
	
	/**
	 * Generate login token to be saved in login table and cookies
	 * this is used to match login token and prevent hack to cookies
	 */
	private function _generateLoginToken()
	{
		$userId = $this->Auth->user('id');
		return md5($userId . date('Y m d H:i:s', strtotime('+2 Weeks')));
		
	}
}
 ?>
