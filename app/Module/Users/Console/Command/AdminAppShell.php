<?php 

/**
 * AdminAppShell
 *
 * @category Controller
 * @package  Module.Users
 * @version  1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://akemis.kodehive.com
 */
App::uses('AppShell', 'Console/Command');

class AdminAppShell extends AppShell{
	/**
	 * Show message between <info /> tag
	 */
	public function info($message = null, $newlines = 1, $level = Shell::NORMAL) {
		$this->out('<info>' . $message . '</info>', $newlines, $level);
	}

	/**
	 * Show message between <warning /> tag
	 */
	public function warning($message = null, $newlines = 1, $level = Shell::NORMAL) {
		$this->out('<warning>' . $message . '</warning>', $newlines, $level);
	}

	/**
	 *Show message between <success /> tag
	 */
	public function success($message = null, $newlines = 1, $level = Shell::NORMAL) {
		$this->out('<success>' . $message . '</success>', $newlines, $level);
	}

	/**
	 *Show message between <error /> tag
	 */
	public function error($message = null, $newlines = 1, $level = Shell::NORMAL) {
		$this->out('<error>' . $message . '</error>', $newlines, $level);
	}
}
