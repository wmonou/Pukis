<?php

App::uses('UsersAppModel', 'Users.Model');

/**
 * AclAro
 *
 * @category Model
 * @package  Module.Users.Model
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
class AclAro extends UsersAppModel {

	/**
	 * name
	 * @var string
	 * @access public
	 */
	public $name = 'AclAro';

	/**
	 * Table used in this model
	 * @var string
	 * @access public
	 */
	public $useTable = 'aros';

	/**
	 * Behavior used in this model
	 * @var array
	 * @access public
	 */
	public $actsAs = array('Tree', 'Containable');

}
