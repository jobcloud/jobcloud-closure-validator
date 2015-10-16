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
        $this->assertEquals(
            array(
                'name' => 'parameter',
                'type' => null,
            ), $parameter->toArray()
        );
    }

    public function testWithType()
    {
        $parameter = new Parameter('parameter', Parameter::classname);

        $this->assertEquals('parameter', $parameter->getName());
        $this->assertEquals(Parameter::classname, $parameter->getType());
        $this->assertEquals(
            array(
                'name' => 'parameter',
                'type' => Parameter::classname,
            ), $parameter->toArray()
        );
    }
}
