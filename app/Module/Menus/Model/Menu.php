<?php
App::uses('MenusAppModel', 'Menus.Model');

/**
 * Menu
 *
 * @category Model
 * @package  Module.User.Model
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
class Menu extends MenusAppModel {

	/**
	 * Model behavior
	 * 
	 * @var unknown
	 */
	public $actsAs = array('ExtendAssociations');

	/**
	 * Validation rules
	 * 
	 * @var array
	 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'required' => false,				
			),
		),
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'MenuItem' => array(
			'className' => 'MenuItem',
			'foreignKey' => 'menu_id',
			'dependent' => false,			
		)
	);

	/**
	 * Non editable menu
	 * 
	 * (non-PHPdoc)
	 * @see Model::beforeSave()
	 */
	public function beforeSave($options = array()){
		if($this->data['Menu']['editable'] == false)
			return false;
	}

}
