<?php

namespace Jobcloud\Tests\ClosureValidator;

use Jobcloud\ClosureValidator\Parameter;
use Jobcloud\ClosureValidator\Signature;

class SignatureTest extends \PHPUnit_Framework_TestCase
{
    public function testWithoutParameter()
    {
        $signature = new Signature();

        $this->assertCount(0, $signature->getParameters());
        $this->assertEquals(array('parameters' => array()), $signature->toArray());
    }

    public function testWithParameter()
    {
        $parameter = new Parameter('parameter', Parameter::CLASS_NAME);
        $signature = new Signature(array($parameter));

        $parameters = $signature->getParameters();

        $this->assertCount(1, $parameters);
        $this->assertEquals($parameter, $parameters[0]);
        $this->assertEquals(
            array(
                'parameters' => array(
                    $parameter->toArray()
                )
            ),
            $signature->toArray()
        );
    }
}
