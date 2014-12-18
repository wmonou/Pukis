<?php
App::uses('UsersAppModel', 'Users.Model');
/**
 * Login Model
 *
 * @property User $User
 */
class Login extends UsersAppModel {

	/**
	 * Use table
	 *
	 * @var mixed False or table name
	 */
	public $useTable = 'login';

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'token' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'expired' => array(
			'datetime' => array(
				'rule' => array('datetime'),
			),
		),
	);

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
