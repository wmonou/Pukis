<?php

/**
 * AclPermission
 *
 * @category Model
 * @package  Module.User.Model
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://akemis.kodehive.com
 */
App::uses('UsersAppModel', 'Users.Model');

class AclPermission extends UsersAppModel {

	/**
	 * name
	 *
	 * @var string
	 */
	public $name = 'AclPermission';

	/**
	 * useTable
	 *
	 * @var string
	 */
	public $useTable = 'aros_acos';
	
	/**
	 * actsAs model behavior
	 *
	 * @var unknown
	 */
	public $actsAs = array('ExtendAssociations', 'Containable');
	
	/**
	 * belongsTo
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'AclAro' => array(
			'className' => 'Users.AclAro',
			'foreignKey' => 'aro_id',
		),
		'AclAco' => array(
			'className' => 'Users.AclAco',
			'foreignKey' => 'aco_id',
		),
	);
	
	
	/**
	 * change permission for certain role with certain access
	 * 
	 * @param integer $roleId
	 * @param array $acoIdList
	 * @param string $permission
	 * @access public
	 */
	public function change($aroId, $acoIdList, $permission = 0)
	{
		// get all aclPermission data
		$aclPermissionData = $this->find('all', array(
			'conditions' => array(
				'AclPermission.aco_id' => $acoIdList,
				'AclPermission.aro_id' => $aroId),
			'fields' => array(
				'AclPermission.id',
				'AclPermission.aco_id'),
			'contain' => false
		));
		
		$aclPermissionIdList = Hash::combine($aclPermissionData, '{n}.AclPermission.aco_id', '{n}.AclPermission.id');

		Wmonou::debug($acoIdList, $aclPermissionData, $aclPermissionIdList);
		
		// permission CRUD;
		$crudPermission = array(
			'AclPermission' => array(
				'_create' => $permission,
				'_read' => $permission,
				'_update' => $permission,
				'_delete' => $permission));
	
		$data = array();
		foreach($acoIdList as $acoId)
		{
			$aclPermissionId = null;
			if(isset($aclPermissionIdList[$acoId])) {
				$aclPermissionId = $aclPermissionIdList[$acoId];
			} 
			
			$aclPermission = array('AclPermission' => array(
					'id' => $aclPermissionId,
					'aco_id' => $acoId,
					'aro_id' => $aroId,
			));
			
			$data[] = Hash::merge($aclPermission, $crudPermission);
		}
	}

}
