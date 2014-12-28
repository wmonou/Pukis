<?php

/**
 * Pukis
 *
 * @package  Pukis.Pukis.Lib
 * @version  1.0
 * @author   Yusuf Widiyatmono <Yusuf.Widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://pukis.kodehive.com
 */
class PukisMenu 
{
	
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
	public static $options = array(
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
	public static function add($menu, $group, $options) 
	{
		$item = array();
		$dimension =& $item;
		
		$groups = explode('.', $group);
		foreach ($groups as $g) {
			$dimension[$g] = array();
			$dimension = &$dimension[$g];
		}
		
		$dimension = (!empty($options))? $options : self::$options;
		
		self::$menu[$menu] = hash::merge(self::$menu[$menu], $item);
	}
	
}