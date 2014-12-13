<?php

/**
 * PermissionsController
 *
 * @category Controller
 * @package  Module.User.Controller
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://akemis.kodehive.com
 */
App::uses('UsersAppController', 'Users.Controller');

class PermissionsController extends UsersAppController {	

	/**
	 * Components
	 *
	 * @var array
	 **/
	public $components = array('Users.AclUtility');

	/**
	 * Models
	 *
	 * @var array
	 **/
	public $uses = array(
		'Users.AclAco',
		'Users.AclAro',
		'Users.AclPermission',
		'Users.Role'
		);

	/**
	 * Controller callback
	 * 
	 * @return void
	 */
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->set('title_for_layout', __d('users', 'Permissions'));
	}

	/**
	 * admin_index
	 * 
	 * @return void
	 */
	public function admin_index()
	{
		$acoConditions = array(
			'parent_id !=' => null,
			'foreign_key' => null,
			'alias !=' => null,
		);
		
		$acos  = $this->AclAco->generateTreeList($acoConditions, '{n}.AclAco.id', '{n}.AclAco.alias');
		$roles = $this->Role->find('list');
				
		$this->set(compact('acos', 'roles'));

		$rolesAros = $this->AclAro->find('all', array(
			'conditions' => array(
				'AclAro.model' => 'Role',
				'AclAro.foreign_key' => array_keys($roles),
				),
			));
		$rolesAros = Set::combine($rolesAros, '{n}.AclAro.foreign_key', '{n}.AclAro.id');
		
		// check permission
		$this->AclPermission->unbindAll();
		$aclPermission = $this->AclPermission->find('all');
		$aclPermission = Hash::combine(
			$aclPermission, 
			'{n}.AclPermission.aro_id', 
			array('create:%s/read:%s/update:%s/delete:%s', 
				'{n}.AclPermission._create', 
				'{n}.AclPermission._read', 
				'{n}.AclPermission._update', 
				'{n}.AclPermission._delete'),
			'{n}.AclPermission.aco_id'
			);
		
		$permissions = array();
		foreach ($acos as $acoId => $acoAlias) {
			if (substr_count($acoAlias, '_') != 0) {
				$permission = array();
				foreach ($roles as $roleId => $roleTitle) {
					if(Hash::check($aclPermission, $acoId . '.' .$rolesAros[$roleId])){
						$permission[$roleId] = 1;
					} else {
						$permission[$roleId] = 0;
					}
					$permissions[$acoId] = $permission;
				}
			}
		}
		
		
		$this->set(compact('rolesAros', 'permissions'));
		
		$controllers = array();
		$controllers[] = $this->AclUtility->getControllerList();
		$plugins = CakePlugin::loaded();
		if ( !empty( $plugins ) ) {
			foreach ($plugins as $plugin) {
				$controllers[] = $this->AclUtility->getControllerList($plugin);
			}
		}
		
		$this->set(compact('controllers'));
	}
	
	/**
	 * admin_change
	 * 
	 * @return void
	 * @todo recursice permission change
	 */
	public function admin_change() {
		if (!$this->request->is('ajax')) {
			$this->redirect(array('action' => 'index'));
		}
		$this->layout = false;
		$acoId = $this->request->data['aco_id'];
		$aroId = $this->request->data['aro_id'];
		
		// see if acoId and aroId combination exists
		$conditions = array(
			'AclPermission.aco_id' => $acoId,
			'AclPermission.aro_id' => $aroId,
		);
		if ($this->AclPermission->hasAny($conditions)) {
			$data = $this->AclPermission->find('first', array('conditions' => $conditions));
			if ($data['AclPermission']['_create'] == 1 &&
				$data['AclPermission']['_read'] == 1 &&
				$data['AclPermission']['_update'] == 1 &&
				$data['AclPermission']['_delete'] == 1)
			{
				// from 1 to 0
				$data['AclPermission']['_create'] = 0;
				$data['AclPermission']['_read'] = 0;
				$data['AclPermission']['_update'] = 0;
				$data['AclPermission']['_delete'] = 0;
				$permitted = 0;
			} else {
				// from 0 to 1
				$data['AclPermission']['_create'] = 1;
				$data['AclPermission']['_read'] = 1;
				$data['AclPermission']['_update'] = 1;
				$data['AclPermission']['_delete'] = 1;
				$permitted = 1;
			}
		} else {
			// create - CRUD with 1
			$data['AclPermission']['aco_id'] = $acoId;
			$data['AclPermission']['aro_id'] = $aroId;
			$data['AclPermission']['_create'] = 1;
			$data['AclPermission']['_read'] = 1;
			$data['AclPermission']['_update'] = 1;
			$data['AclPermission']['_delete'] = 1;
			$permitted = 1;
		}

		// save
		$success = 0;
		if ($this->AclPermission->save($data)) {
			$success = 1;
		}
		$this->set(compact('success'));
	}
	
	/**
	 * admin_sync
	 * 
	 * @return void
	 */
	public function admin_sync()
	{
		if ( $this->AclUtility->aco_sync() ) {
			$this->Session->setFlash(__d('users', 'All Controllers was sincronized.'), 'flash_success');
			$this->redirect(array('action' => 'index'));
		}
		$this->render(false);
	}
}

 ?>