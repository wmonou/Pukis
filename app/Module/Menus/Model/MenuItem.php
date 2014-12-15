<?php
App::uses('MenusAppModel', 'Menus.Model');

/**
 * MenuItem
 *
 * @category Model
 * @package  Module.Menu.Model
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
class MenuItem extends MenusAppModel {

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
				'required' => true				
			),
		),
		'alias' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'required' => true				
			),
		),
	);

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'ParentMenuItem' => array(
			'className' => 'MenuItem',
			'foreignKey' => 'parent_id',			
		),
		'Menu' => array(
			'className' => 'Menu',
			'foreignKey' => 'menu_id',			
		)
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'ChildMenuItem' => array(
			'className' => 'MenuItem',
			'foreignKey' => 'parent_id',
			'dependent' => false,			
		)
	);

}
