<?php 

App::uses('UsersAppModel', 'Users.Model');

/**
 * Role
 *
 * @category Model
 * @package  Module.Users.Model
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
class Role extends UsersAppModel {
    
    /**
     * Behavior used in this model
     * @var array
     * @access public
     **/
    public $actsAs = array(
    	'Acl' => array('type' => 'requester'),
    	'Containable'
    );
    
    /**
     * validationDomain - for translated validations messages
     * @var string
     * @access public
     **/
	public $validationDomain = 'model_validation';
	
	/**
	* Validation rules
	* @var array
	* @access public
	*/
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Name field is required.'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
                'on' => 'create',
				'message' => 'This group already exists.',
				'last' => true
			)));
	
	/**
	* Model hasMany relation
	* @var array
	* @access public
	*/
    public $hasMany = array(
    	'User' => array(
	    	'className' => 'Users.User', 
	    	'foreignKey' => 'role_id'
    	));
    
    /**
     * @return NULL
     * @access public
     */
    public function parentNode() {
        return null;
    }
}