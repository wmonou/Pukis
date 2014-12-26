<?php

/**
 * AclAco
 *
 * @category Model
 * @package  Module.User.Model
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://akemis.kodehive.com
 */
App::uses('UsersAppModel', 'Users.Model');

class AclAco extends UsersAppModel {

	/**
	 * name
	 *
	 * @var string
	 */
	public $name = 'AclAco';

	/**
	 * useTable
	 *
	 * @var string
	 */
	public $useTable = 'acos';

	/**
	 * actsAs - Acl Behavior
	 *
	 * @var array
	 */
	public $actsAs = array('Tree', 'Containable');

	
}
