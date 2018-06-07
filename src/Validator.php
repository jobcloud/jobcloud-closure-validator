<?php

namespace Jobcloud\ClosureValidator;

class Validator
{

    /**
     * @var string
     */
    const CLASS_NAME = __CLASS__;

    /**
     * @param \Closure $closure
     *
     * @return Signature
     */
    public function getSignatureFromClosure(\Closure $closure)
    {
        $parameters = [];

        $reflectionFunction = new \ReflectionFunction($closure);
        foreach ($reflectionFunction->getParameters() as $reflectionParameter) {
            $parameters[] = new Parameter(
                $reflectionParameter->getName(),
                $this->getTypeByReflectionParameter($reflectionParameter)
            );
        }

        return new Signature($parameters);
    }

    /**
     * @param Signature $givenSignature
     * @param Signature $wishedSignature
     *
     * @return Diff
     */
    public function compare(Signature $givenSignature, Signature $wishedSignature)
    {
        $givenParameters = $givenSignature->getParameters();
        $wishedParameters = $wishedSignature->getParameters();

        $missingParameters = $this->getDifferentParameter($wishedParameters, $givenParameters);
        $additionalParameters = $this->getDifferentParameter($givenParameters, $wishedParameters);

        return new Diff($missingParameters, $additionalParameters);
    }

    /**
     * @param Signature $givenSignature
     * @param Signature $wishedSignature
     * @return void
     *
     * @throws InvalidClosureException
     */
    public function validOrException(Signature $givenSignature, Signature $wishedSignature)
    {
        $diff = $this->compare($givenSignature, $wishedSignature);
        if (!$diff->isIdentical()) {
            throw new InvalidClosureException(sprintf('Invalid closure: %s', json_encode($diff->toArray())));
        }
    }

    /**
     * @param array $parameters1
     * @param array $parameters2
     *
     * @return array
     */
    protected function getDifferentParameter(array $parameters1, array $parameters2)
    {
        $differentParameters = [];
        foreach ($parameters1 as $i => $parameter1) {
            if (!isset($parameters2[$i]) || $parameter1 != $parameters2[$i]) {
                $differentParameters[] = $parameter1;
            }
        }

        return $differentParameters;
    }

    /**
     * @param \ReflectionParameter $reflectionParameter
     *
     * @return null|string
     */
    protected function getTypeByReflectionParameter(\ReflectionParameter $reflectionParameter)
    {
        if ($reflectionParameter->getClass()) {
            return $reflectionParameter->getClass()->getName();
        }

        if ($reflectionParameter->isArray()) {
            return 'array';
        }

        return null;
    }
}
