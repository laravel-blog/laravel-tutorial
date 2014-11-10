<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {


	public function setUp() {
		parent::setUp(); // TODO: Change the autogenerated stub
		$this->_prepareForTests();
	}

	protected function _prepareForTests() {
		Artisan::call( 'migrate' );
	}

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication() {
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__ . '/../../bootstrap/start.php';
	}

}
