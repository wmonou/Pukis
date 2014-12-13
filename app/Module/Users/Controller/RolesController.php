<?php

/**
 * RolesController
 *
 * @category Controller
 * @package  Module.User.Controller
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://akemis.kodehive.com
 */
App::uses('UsersAppController', 'Users.Controller');

class RolesController extends UsersAppController{
	
	/**
	 * Controller callback
	 * 
	 * @return void
	 */
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->set('title_for_layout', __d('admin', 'Roles'));
	}
	
	/**
	 * admin_index
	 * 
	 * @return void
	 */
	public function admin_index()
	{
		$this->paginate['Role']['order'] = 'Role.id Desc';
		$this->set('groups', $this->paginate('Role'));
	}
	
	/**
	 * admin_Add
	 * 
	 * @return void
	 */
	public function admin_add()
	{
		if ( !empty( $this->request->data ) ) {
			$this->Role->create();
			if ( $this->Role->save( $this->request->data ) ) {
				$this->Session->setFlash(__d('admin', 'Role created.'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	
	/**
	 * admin_edit
	 * 
	 * @param $id Role id
	 * @return void
	 */
	public function admin_edit( $id = null )
	{
		if( !$id )
		{
			$this->Session->setFlash(__d('admin', "Invalid ID"), 'flash_error');
			$this->redirect(array("action" => 'index'));			
		}
		if( !empty( $this->request->data ) )
		{
			if( $this->Role->save( $this->request->data ) )
			{
				$this->Session->setFlash(__d('admin', "The Role was saved."), 'flash_success');
				$this->redirect(array("action" => 'index'));		
			}			
		}
		$this->request->data = $this->Role->read(null, $id);
	}
	
	/**
	 * admin_delete
	 * 
	 * @param  $id Role id
	 * 
	 * @return void
	 */
	public function admin_delete( $id = null )
	{
		if( !$id )
		{
			$this->Session->setFlash(__d('admin', 'Invalid ID.'), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		if( $this->Role->delete( $id ) )
		{
			$this->Session->setFlash(__d('admin', 'The user was deleted.'), 'flash_success');
			$this->redirect(array('action' => 'index'));
		}
	}
}