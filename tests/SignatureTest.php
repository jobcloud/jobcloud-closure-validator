<?php

namespace Jobcloud\Tests\ClosureValidator;

use Jobcloud\ClosureValidator\Parameter;
use Jobcloud\ClosureValidator\Signature;
use PHPUnit\Framework\TestCase;

class SignatureTest extends TestCase
{
    public function testWithoutParameter()
    {
        $signature = new Signature();

        $this->assertCount(0, $signature->getParameters());
        $this->assertEquals(['parameters' => []], $signature->toArray());
    }

    public function testWithParameter()
    {
        $parameter = new Parameter('parameter', Parameter::CLASS_NAME);
        $signature = new Signature([$parameter]);

        $parameters = $signature->getParameters();

        $this->assertCount(1, $parameters);
        $this->assertEquals($parameter, $parameters[0]);
        $this->assertEquals(
            [
                'parameters' => [
                    $parameter->toArray()
                ]
            ],
            $signature->toArray()
        );
    }
}
