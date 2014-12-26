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
		$this->Auth->allow('test');
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
		
		// retreive all permission
		$aclPermission = $this->AclPermission->find('all', array('contain' => false));
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
		
		// check permission
		$permissions = array();
		foreach ($acos as $acoId => $acoAlias) {
			if (substr_count($acoAlias, '_') != 0) {
				$permission = array();
				foreach ($roles as $roleId => $roleTitle) {
					// check if its already has entry on acl permission
					if(Hash::check($aclPermission, $acoId . '.' . $rolesAros[$roleId])){
						// check value if its 1 or 0
						if($aclPermission[$acoId][$rolesAros[$roleId]] == 'create:1/read:1/update:1/delete:1'){
							$permission[$roleId] = 1;
						} else {
							$permission[$roleId] = 0;
						}
					} else {
						$permission[$roleId] = 0;
					}
					$permissions[$acoId] = $permission;
				}
			}
		}
		
		
		$this->set(compact('rolesAros', 'permissions'));
		
		// get controller list
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
			$this->ajaxRedirect('/admin/users/permissions/index');
		}
		
		if(empty($this->request->data)) {
			$this->ajaxRedirect('/admin/users/permissions/index');
		}
		
		$this->layout = false;
		$acoId = $this->request->data['aco_id'];
		$aroId = $this->request->data['aro_id'];
		
		// look for current permission
		$permissionData = $this->AclPermission->find('first', array(
			'conditions' => array(
				'AclPermission.aco_id' => $acoId,
				'AclPermission.aro_id' => $aroId),
			'contain' => false
		));
		
		// search for parent and child alias
		$this->AclAco->bindModel(array(
			'hasMany' => array(
				'AclAcoChild' => array(
					'className' => 'AclAco',
					'foreignKey' => 'parent_id')),
			'belongsTo' => array(
				'AclAcoParent' => array(
					'className' => 'AclAco',
					'foreignKey' => 'parent_id'))));
		$acoData = $this->AclAco->find('first', array(
				'conditions' => array('AclAco.id' => $acoId)));
	
		// if parent is empty means it is already the first parents
		// if childs are empty means it is already the last child
		// if allowing, parent and childs should be allowed too
		// if disallowing, parent doesnt need to be dissallowed but child does
		$success = false;
		if (!empty($permissionData)) {
			if ($permissionData['AclPermission']['_create'] == 1 &&
				$permissionData['AclPermission']['_read'] == 1 &&
				$permissionData['AclPermission']['_update'] == 1 &&
				$permissionData['AclPermission']['_delete'] == 1)
			{
				// disallowing
				// list acoId only for self and childs
				$acoIdList = array($acoId);
				if (!empty($acoData['AclAcoChild'])) {
					$acoChildIdList = array();
					foreach ($acoData['AclAcoChild'] as $acoChild) {
						$acoChildIdList[] = $acoChild['id'];
					}
					$acoIdList = Hash::merge($acoIdList, $acoChildIdList);					
				}
				$success = $this->AclPermission->change($aroId, $acoIdList, 0);
			} else {
				// allowing
				// list acoId for self, parent, and childs
				$acoIdList = array($acoId);
				if (!empty($acoData['AclAcoParent'])) {
					$acoIdList = Hash::merge($acoIdList, array($acoData['AclAcoParent']['id']));
				}
				if (!empty($acoData['AclAcoChild'])) {
					$acoChildIdList = array();
					foreach ($acoData['AclAcoChild'] as $acoChild) {
						$acoChildIdList[] = $acoChild['id'];
					}
					$acoIdList = Hash::merge($acoIdList, $acoChildIdList);
				}
				$success = $this->AclPermission->change($aroId, $acoIdList, 1);
			}
		} else {
			// allowing
			// list acoId for self, parent and childs
			$acoIdList = array($acoId);
			if (!empty($acoData['AclAcoParent'])) {
				$acoIdList = Hash::merge($acoIdList, array($acoData['AclAcoParent']['id']));
			}
			if (!empty($acoData['AclAcoChild'])) {
				$acoChildIdList = array();
				foreach ($acoData['AclAcoChild'] as $acoChild) {
					$acoChildIdList[] = $acoChild['id'];
				}
				$acoIdList = Hash::merge($acoIdList, $acoChildIdList);
			}
			$success = $this->AclPermission->change($aroId, $acoIdList, 1);
		}
		
		// save	
		if ($success) {
			$this->Session->setFlash(__d('users', 'Permission has been changed!'), 'flash_success', array('plugin' => 'Pukis'));
		} else {
			$this->Session->setFlash(__d('users', 'Unknown error occured!'), 'flash_error', array('plugin' => 'Pukis'));
		}
		$this->ajaxRedirect('/admin/users/permissions/index');
	}
	
	/**
	 * admin_sync
	 * 
	 * @return void
	 */
	public function admin_sync()
	{
		if ($this->AclUtility->aco_sync()) {
			$this->Session->setFlash(__d('users', 'All Controllers was sincronized.'), 'flash_success', array('plugin' => 'Pukis'));
			$this->ajaxRedirect('/admin/users/permissions/index');
		}
	}
	
}

 ?>