<?php

namespace Jobcloud\Tests\ClosureValidator;

use Jobcloud\ClosureValidator\Parameter;
use PHPUnit\Framework\TestCase;

class ParameterTest extends TestCase
{
    public function testWithoutType()
    {
        $parameter = new Parameter('parameter');

        $this->assertEquals('parameter', $parameter->getName());
        $this->assertNull($parameter->getType());
        $this->assertEquals(
            array(
                'name' => 'parameter',
                'type' => null
            ),
            $parameter->toArray()
        );
    }

    public function testWithType()
    {
        $parameter = new Parameter('parameter', Parameter::CLASS_NAME);

        $this->assertEquals('parameter', $parameter->getName());
        $this->assertEquals(Parameter::CLASS_NAME, $parameter->getType());
        $this->assertEquals(
            array(
                'name' => 'parameter',
                'type' => Parameter::CLASS_NAME
            ),
            $parameter->toArray()
        );
    }
}
