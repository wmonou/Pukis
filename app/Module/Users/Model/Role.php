<?php 

/**
 * Role
 *
 * @category Model
 * @package  Module.User.Model
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://akemis.kodehive.com
 */
App::uses('UsersAppModel', 'Users.Model');

class Role extends UsersAppModel {
    
    /**
     * ActsAs - Acl Behavior
     *
     * @var array
     **/
    public $actsAs = array('Acl' => array('type' => 'requester'));
    
    /**
     * validationDomain - for translated validations messages
     *
     * @var string
     **/
	public $validationDomain = 'model_validation';
	
	/**
	* Validation rules
	*
	* @var array
	*/
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Name field is required.',
			),
			'isUnique' => array(
				'rule' => 'isUnique',
                'on' => 'create',
				'message' => 'This group already exists.',
				'last' => true,
			),
		),
	);
	
	/**
	* hasMany
	*
	* @var array
	*/
    public $hasMany = array('User' => array(
    	'className' => 'Users.User', 
    	'foreignKey' => 'role_id'
    	));
    
    /**
     * 
     * @return NULL
     */
    public function parentNode() {
        return null;
    }
}
 ?>