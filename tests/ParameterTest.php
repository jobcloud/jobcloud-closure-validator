<?php

namespace Jobcloud\Tests\ClosureValidator;

use Jobcloud\ClosureValidator\Parameter;

class ParameterTest extends \PHPUnit_Framework_TestCase
{
    public function testWithoutType()
    {
        $parameter = new Parameter('parameter');

        $this->assertEquals('parameter', $parameter->getName());
        $this->assertNull($parameter->getType());
    }

    public function testWithType()
    {
        $parameter = new Parameter('parameter', Parameter::class);

        $this->assertEquals('parameter', $parameter->getName());
        $this->assertEquals(Parameter::class, $parameter->getType());
    }
}
