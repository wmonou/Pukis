<?php

/**
 * UsersController
 *
 * @category Controller
 * @package  Module.User.Controller
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://akemis.kodehive.com
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
	}
	
	/**
	 * Index
	 * 
	 * @return void
	 */
	public function admin_index(){
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
				$this->Session->setFlash(__d('users', 'User saved.'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			}
		}
		$roles = $this->Role->find('list');
		$this->set(compact('roles'));
	}
	
	/**
	 * User Edit
	 * 
	 * @param $id User ID
	 * @return void
	 */
	public function admin_edit( $id = null ){
		if ( !$id ) {
			$this->Session->setFlash(__d('users', 'Invalid ID'), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		if ( !empty( $this->request->data ) ) {
			if ( $this->User->save($this->request->data) ) {
				$this->Session->setFlash(__d('users', 'User was saved.'), 'flash_success');
			}
		}
		$this->request->data = $this->User->read(null, $id);
		$roles = $this->Role->find('list');
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
			//return $this->ajaxRedirect($this->Auth->redirect());
		}
		
		if ( $this->request->is('post') ) {
// 			if ( $this->Auth->login() ) {
// 				return $this->ajaxRedirect($this->Auth->redirect());
// 			}
			
			if ($this->Auth->login()) {
			
				// did they select the remember me checkbox?
				if ($this->request->data['User']['remember_me'] == 1) {
					// remove "remember me checkbox"
					unset($this->request->data['User']['remember_me']);
					
					// hash the user's password
					$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
			
					// write the cookie
					$this->Cookie->write('remember_me_cookie', $this->request->data['User'], true, '2 weeks');
				}
			
				return $this->redirect($this->Auth->redirect());
				
			}
		}
		
	}
	
	/**
	 * Logout
	 * 
	 * @return void
	 */
	public function admin_logout()
	{
		if ( $this->Auth->logout() ) {
			return $this->ajaxRedirect($this->Auth->redirect());
		}
	}
	
	/**
	 * Reset Password
	 * 
	 * @param  $id User ID
	 * @return void
	 */
	public function admin_change_password( $id = null )
	{
		if ( !$id ) {
			$this->Session->setFlash(__d('users', 'Invalid ID'), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		if ( !empty( $this->request->data ) ) {
			if ( $this->User->save($this->request->data) ) {
				$this->Session->setFlash(__d('users', 'password was saved.'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	
	/**
	 * Delete User
	 * 
	 * @param $id User ID
	 * @return void
	 */
	public function admin_delete( $id = null ){
		if ( !$id ) {
			$this->Session->setFlash(__d('users', 'Invalid ID!'), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		if ( $this->User->delete( $id ) ) {
			$this->Session->setFlash(__d('users', 'User was deleted.'), 'flash_success');
			$this->redirect(array('action' => 'index'));
		}
	}
		
	/**
	 *  Install
	 */
	public function admin_install(){
		$this->AclAco->create(array('parent_id' => null, 'alias' => 'controllers'));
		$this->AclAco->save();
	}
}
 ?>
