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
}

?>

