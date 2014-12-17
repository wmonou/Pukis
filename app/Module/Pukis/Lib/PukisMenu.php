<?php

/**
 * Pukis
 *
 * @package  Pukis.Pukis.Lib
 * @version  1.0
 * @author   Yusuf Widiyatmono <Yusuf.Widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.Pukis.org
 */
class PukisMenu {
	
	/**
	 * Menu variable
	 * 
	 * @var unknown
	 */
	public static $menu = array('sidebar' => array());	
	
	/**
	 * Default item menu value
	 * 
	 * @var unknown
	 */
	private $_default = array(
		'title' => false,
		'icon' => false,
		'url' => '#',
		'children' => array()
	);
	
	/**
	 * Add item to menu
	 * 
	 * @param unknown $group
	 */
	public static function add($menu, $group, $option) 
	{
		$item = array();
		$dimension =& $item;

		$groups = explode('.', $group);
		foreach ($groups as $g) {
			$dimension[$g] = array();
			$dimension = &$dimension[$g];
		}
		
		$dimension = (!empty($option))? $option : $this->_default;
		
		self::$menu[$menu] = hash::merge(self::$menu[$menu], $item);
	}
	
}