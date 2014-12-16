<?php

/**
 * Class debuger
 * 
 * @author Wmonou 
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
	public static function debug () {
		Wmonou::$args = func_get_args();
	}
	
	/**
	 * to print assign argument
	 * 
	 * @access public static 
	 */
	public static function printd() {
		Wmonou::$args = func_get_args();
		
		foreach (Wmonou::$args as $arg) {
			print_r('<pre>');
			print_r($arg);
			print_r('</pre>');
		}
	}
}

?>

