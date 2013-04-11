<?php namespace Orchestra\Memory\Tests\Drivers;

class RuntimeTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Stub instance.
	 *
	 * @var Orchestra\Memory\Drivers\Runtime
	 */
	protected $stub = null;

	/**
	 * Setup the test environment.
	 */
	public function setUp()
	{
		$this->stub = new \Orchestra\Memory\Drivers\Runtime('stub', array());
	}

	/**
	 * Teardown the test environment.
	 */
	public function tearDown()
	{
		unset($this->stub);
	}

	/**
	 * Test Orchestra\Memory\Drivers\Runtime::__construct()
	 *
	 * @test
	 * @group support
	 */
	public function testConstructMethod()
	{
		$refl    = new \ReflectionObject($this->stub);
		$name    = $refl->getProperty('name');
		$storage = $refl->getProperty('storage');

		$name->setAccessible(true);
		$storage->setAccessible(true);

		$this->assertEquals('runtime', $storage->getValue($this->stub));
		$this->assertEquals('stub', $name->getValue($this->stub));
	}

	/**
	 * Test Orchestra\Memory\Drivers\Runtime::initiate()
	 *
	 * @test
	 * @group support
	 */
	public function testInitiateMethod()
	{
		$this->assertTrue($this->stub->initiate());
	}

	/**
	 * Test Orchestra\Memory\Drivers\Runtime::shutdown()
	 *
	 * @test
	 * @group support
	 */
	public function testShutdownMethod()
	{
		$this->assertTrue($this->stub->shutdown());
	}
}