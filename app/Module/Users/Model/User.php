<?php

App::uses('UsersAppModel', 'Users.Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * User
 *
 * @category Model
 * @package  Module.User.Model
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
class User extends UsersAppModel {
    
    /**
     * actsAs - Acl Behavior
     *
     * @var array
     **/	
    public $actsAs = array('Acl' => array('type' => 'requester', 'enabled' => false));

    /**
     * belongsTo relationship
     *
     * @var array
     **/
	public $belongsTo = array(
        'Role' => array(
            'className' => 'Users.Role', 
            'foreignKey' => 'role_id'
            )
        );
    
    /**
     * validationDomain - for translated validations messages
     *
     * @var string
     **/
	public $validationDomain = 'model_validation';
	
	
	/**
	 * validation rules
	 *
	 * @var array
	 **/    
	public $validate = array(
		'email' => array(
			'isUnique' => array(
				'rule' => 'isUnique',
                'on' => 'create',
				'message' => 'This email already exists.',
				'last' => true,
			),
			'email' => array(
				'rule' => 'email',
				'message' => 'Invalid E-mail.',
				'last' => true,
			),			
		),
		'username' => array(
			'isUnique' => array(
				'rule' => 'isUnique',
                'on' => 'create',
				'message' => 'This username already exists.',
				'last' => true,
			),
		),
		'password' => array(
			'rule' => array('minLength', 6),
			'message' => 'Password must be have 6 characters at minimum.',
		),
		'password_again' => array(
			'rule' => 'validate_password_again',
			'message' => 'The passwords no match.'		
		),
	);
	
	/**
	 * parentNode
	 *
	 * @return void
	 **/	
    public function parentNode() {
            if (!$this->id && empty($this->data)) {
                return null;
            }
            if (isset($this->data['User']['role_id'])) {
                $groupId = $this->data['User']['role_id'];
            } else {
                $groupId = $this->field('role_id');
            }
            if (!$groupId) {
                return null;
            } else {            	
                return array('Role' => array('id' => $data['User']['role_id']));
            }
    }

    /**
     * bindNode
     *
     * @return void
     **/
    public function bindNode($user) {
        return array('model' => 'Role', 'foreign_key' => $user['Users.User']['role_id']);
    }

    public function beforeSave($options = array()) {
        if (!empty( $this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password(
                      $this->data['User']['password']
                    );
            $this->data["User"]['status'] = 1;
        }
        return true;
    }
	
	/**
	 * validate_password_again
	 *
	 * @return void
	 **/
	public function validate_password_again() {
		if (isset($this->data['User']['password'])) {
			if ($this->data['User']['password'] != $this->data['User']['password_again']) {
				return false;
			}
		}
		return true;
		}
}
 ?>