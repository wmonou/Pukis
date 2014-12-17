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
	 * Returns an array in for menu
	 *
	 * @param array $json
	 * @return string
	 * @author http://recursive-design.com/blog/2008/03/11/format-json-with-php/
	 */		
	public static function fetch(){
		$plugins = CakePlugin::loaded();
		$config = 'Config' . DS . 'admin_menu.php';
		foreach ($plugins as $plugin) {
			$file = CakePlugin::path($plugin) . $config;
			if (file_exists($file)) {
				require $file;
			}
		}
	}
	
	
	
}