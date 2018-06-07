<?php

namespace Jobcloud\Tests\ClosureValidator;

use Jobcloud\ClosureValidator\Diff;
use Jobcloud\ClosureValidator\Parameter;
use PHPUnit\Framework\TestCase;

class DiffTest extends TestCase
{
    public function testIdentical()
    {
        $diff = new Diff();

        $this->assertTrue($diff->isIdentical());
        $this->assertEquals(
            [
                'missingParameters' => [],
                'additionalParameters' => []
            ],
            $diff->toArray()
        );
    }

    public function testMissingParameter()
    {
        $parameter = new Parameter('parameter');

        $diff = new Diff([$parameter]);

        $missingParameters = $diff->getMissingParameters();

        $this->assertFalse($diff->isIdentical());
        $this->assertSame($parameter, $missingParameters[0]);
        $this->assertEquals(
            [
                'missingParameters' => [
                    $parameter->toArray()
                ],
                'additionalParameters' => []
            ],
            $diff->toArray()
        );
    }

    public function testAdditionalParameter()
    {
        $parameter = new Parameter('parameter');

        $diff = new Diff([], [$parameter]);

        $additionalParameters = $diff->getAdditionalParameters();

        $this->assertFalse($diff->isIdentical());
        $this->assertSame($parameter, $additionalParameters[0]);
        $this->assertEquals(
            [
                'missingParameters' => [],
                'additionalParameters' => [
                    $parameter->toArray()
                ]
            ],
            $diff->toArray()
        );
    }
}
