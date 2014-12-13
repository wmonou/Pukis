<?php

App::uses('Model', 'Model');

/**
 * User
 *
 * @category Model
 * @package  Module.Pukis.Model
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://akemis.kodehive.com
 */
class AppModel extends Model {
	
	/**
	 * actsAs model behavior
	 *
	 * @var unknown
	 */
	public $actsAs = array('ExtendAssociations');

}
