<?php

namespace Jobcloud\Tests\ClosureValidator;

use Jobcloud\ClosureValidator\Diff;
use Jobcloud\ClosureValidator\Parameter;

class DiffTest extends \PHPUnit_Framework_TestCase
{
    public function testIdentical()
    {
        $diff = new Diff();

        $this->assertTrue($diff->isIdentical());
    }

    public function testMissingParameter()
    {
        $parameter = new Parameter('parameter');

        $diff = new Diff(array($parameter));

        $missingParameters = $diff->getMissingParameters();

        $this->assertFalse($diff->isIdentical());
        $this->assertSame($parameter, $missingParameters[0]);
    }

    public function testAdditionalParameter()
    {
        $parameter = new Parameter('parameter');

        $diff = new Diff(array(), array($parameter));

        $additionalParameters = $diff->getAdditionalParameters();

        $this->assertFalse($diff->isIdentical());
        $this->assertSame($parameter, $additionalParameters[0]);
    }
}
