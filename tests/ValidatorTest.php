<?php

namespace Jobcloud\Tests\ClosureValidator;

use Jobcloud\ClosureValidator\Diff;
use Jobcloud\ClosureValidator\Parameter;
use Jobcloud\ClosureValidator\Signature;
use Jobcloud\ClosureValidator\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSignatureFromClosure()
    {
        $useParameter = 'test';

        $closure = function (Parameter $parameter) use ($useParameter) { return $useParameter; };

        $validator = new Validator();

        $signature = $validator->getSignatureFromClosure($closure);

        $this->assertEquals(new Signature(array(new Parameter('parameter', Parameter::classname))), $signature);
    }

    public function testCompare()
    {
        $useParameter = 'test';

        $closure = function (Parameter $parameter) use ($useParameter) { return $useParameter; };

        $validator = new Validator();

        $givenSignature = $validator->getSignatureFromClosure($closure);

        $wishedSignature = new Signature(array(new Parameter('parameter', Parameter::classname)));

        $diff = $validator->compare($givenSignature, $wishedSignature);

        $this->assertInstanceOf(Diff::classname, $diff);
        $this->assertTrue($diff->isIdentical());
    }

    public function testCompareWithDiffrentParamerter()
    {
        $useParameter = 'test';

        $closure = function (Parameter $parameter) use ($useParameter) { return $useParameter; };

        $validator = new Validator();

        $givenSignature = $validator->getSignatureFromClosure($closure);

        $wishedSignature = new Signature(array(new Parameter('parameter1', Parameter::classname)));

        $diff = $validator->compare($givenSignature, $wishedSignature);

        $this->assertInstanceOf(Diff::classname, $diff);
        $this->assertFalse($diff->isIdentical());
        $this->assertCount(1, $diff->getMissingParameters());
        $this->assertCount(1, $diff->getAdditionalParameters());
    }

    public function testCompareWithMissingParamerter()
    {
        $useParameter = 'test';

        $closure = function () use ($useParameter) { return $useParameter; };

        $validator = new Validator();

        $givenSignature = $validator->getSignatureFromClosure($closure);

        $wishedSignature = new Signature(array(new Parameter('parameter', Parameter::classname)));

        $diff = $validator->compare($givenSignature, $wishedSignature);

        $this->assertInstanceOf(Diff::classname, $diff);
        $this->assertFalse($diff->isIdentical());
        $this->assertCount(1, $diff->getMissingParameters());
        $this->assertCount(0, $diff->getAdditionalParameters());
    }

    public function testCompareWithAdditionalParamerter()
    {
        $useParameter = 'test';

        $closure = function (Parameter $parameter1, array $parameter2, $parameter3) use ($useParameter) { return $useParameter; };

        $validator = new Validator();

        $givenSignature = $validator->getSignatureFromClosure($closure);

        $wishedSignature = new Signature(array(new Parameter('parameter1', Parameter::classname)));

        $diff = $validator->compare($givenSignature, $wishedSignature);

        $this->assertInstanceOf(Diff::classname, $diff);
        $this->assertFalse($diff->isIdentical());
        $this->assertCount(0, $diff->getMissingParameters());
        $this->assertCount(2, $diff->getAdditionalParameters());
    }
}
