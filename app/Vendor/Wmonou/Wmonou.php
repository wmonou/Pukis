<?php

/**
 * Class debuger for multi argument
 * @author ”Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>”
 *
 */
Class Wmonou {

	/**
	 * to print debug argument from view
	 * 
	 * @access public static
	 */
	public static $args;

	/**
	 * to set debug argument from controller
	 * 
	 * #access public static
	 */
	public static function debug () 
	{
		self::$args = func_get_args();

		print_r('<pre style="z-index: 1000;">');
		foreach (Wmonou::$args as $arg) {
			print_r($arg);			
		}
		print_r('</pre>');
	}
	
}

?>

