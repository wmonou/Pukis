<?php
App::uses('Login', 'Users.Model');

/**
 * Login Test Case
 *
 */
class LoginTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.users.login',
		'plugin.users.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Login = ClassRegistry::init('Users.Login');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Login);

		parent::tearDown();
	}

}
