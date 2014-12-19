<?php

App::uses('PukisJson', 'Pukis.Lib');

/**
 * PukisJsonReader
 *
 * @package  Pukis.Lib.Configure
 * @since    1.0
 * @author   Yusuf Widiyatmono <yusuf.widiyatmono@wmonou.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.Pukis.org
 */
class PukisJsonReader implements ConfigReaderInterface {

	/**
	 * Default path to store file
	 */
	protected $_path = null;

	/**
	 * __construct
	 *
	 */
	public function __construct($path = null) {
		$this->_path = $path;
	}

	/**
	 * Read an json file and return the results as an array.
	 *
	 * @params $key string name key to read
	 * @throws ConfigureException
	 */
	public function read($file) {
		$file = $this->_file($file);
		if (!is_file($file)) {			
			if (!is_file(substr($file, 0, -4))) {
				throw new ConfigureException(__d('Pukis', 'Could not load configuration files: %s or %s', $file, substr($file, 0, -4)));
			}
		}
		
		$config = json_decode(file_get_contents($file), true);
		return $config;
	}

	/**
	 * Dumps the state of Configure data into an json string.
	 */
	public function dump($file, $data) {
		$file = $this->_file($file);
		if (!is_file($file)) {
			if (!is_file(substr($file, 0, -4))) {
				throw new ConfigureException(__d('Pukis', 'Could not load configuration files: %s or %s', $file, substr($file, 0, -4)));
			}
		}
		
		$options = 0;
		if (version_compare(PHP_VERSION, '5.3.3', '>=')) {
			$options |= JSON_NUMERIC_CHECK;
		}
		if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
			$options |= JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT;
		}
		
		$contents = PukisJson::stringify($data, $options);
		return $this->_writeFile($file, $contents);
	}

	/**
	 * _writeFile
	 *
	 */
	protected function _writeFile($file, $contents) {
		return file_put_contents($file, $contents);
	}
	
	/**
	 * 
	 * @param unknown $file
	 * @return string
	 */
	protected function _file($file) {
		if (strpos($file, '..') !== false) {
			throw new ConfigureException(__d('Pukis', 'Cannot load configuration files with ../ in them.'));
		}
		
		if (substr($file, -5) === '.json') {
			$file = substr($file, 0, -5);
		}
		
		list($plugin, $key) = pluginSplit($file);
		
		if ($plugin) {
			$file = App::pluginPath($plugin) . 'Config' . DS . $file .'.json';
		} else {
			$file = $this->_path . $key . '.json';
		}
		
		return $file;
	}

}

