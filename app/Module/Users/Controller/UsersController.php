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
	public $uses = array('Users.User', 'Users.Role');

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
	 * admin_index
	 * 
	 * @return void
	 */
	public function admin_index(){
		$this->paginate['User']['order'] = 'User.id Desc';
		$this->set('users', $this->paginate('User'));
	}
	
	/**
	 * admin_add
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
	 * admin_edit
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
		$groups = $this->Role->find('list');
		$this->set(compact('groups'));
	}
	
	/**
	 * admin_login
	 * 
	 * @return void
	 */
	public function admin_login()
	{
		
			if ( $this->request->is('post') ) {
				if ( $this->Auth->login() ) {
					return $this->ajaxRedirect($this->Auth->redirect());
				}
			}
		
	}
	
	/**
	 * admin_logout
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
	 * admin_reset_password
	 * 
	 * @param  $id User ID
	 * @return void
	 */
	public function admin_reset_password( $id = null )
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
	 * admin_delete
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
	
	public function admin_install(){
		$this->AclAco->create(array('parent_id' => null, 'alias' => 'controllers'));
		$this->AclAco->save();
	}
}
 ?>
