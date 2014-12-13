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
	public $actsAs = array('ExtendAssociations');
	
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

}
