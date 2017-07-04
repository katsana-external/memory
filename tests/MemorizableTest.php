<?php

namespace Orchestra\Memory\Abstractable\TestCase;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Orchestra\Memory\Memorizable;

class MemorizableTest extends TestCase
{
    use Memorizable;

    /**
     * Test multiple functionality of Orchestra\Memory\Abstractable\Container.
     *
     * @test
     */
    public function testAttachingMemoryProviders()
    {
        $mock = m::mock('\Orchestra\Memory\Provider');

        $this->assertFalse($this->attached());

        $this->attach($mock);

        $this->assertEquals($mock, $this->memory);
        $this->assertEquals($mock, $this->getMemoryProvider());
        $this->assertTrue($this->attached());
    }
}
