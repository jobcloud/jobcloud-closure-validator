<?php

namespace Jobcloud\ClosureValidator;

class Validator
{
    const classname = __CLASS__;

    /**
     * @param \Closure $closure
     *
     * @return Signature
     */
    public function getSignatureFromClosure(\Closure $closure)
    {
        $parameters = array();

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

        $missingParameters = $this->getDiffrentParameter($wishedParameters, $givenParameters);
        $additionalParameters = $this->getDiffrentParameter($givenParameters, $wishedParameters);

        return new Diff($missingParameters, $additionalParameters);
    }

    /**
     * @param array $parameters1
     * @param array $parameters2
     *
     * @return array
     */
    protected function getDiffrentParameter(array $parameters1, array $parameters2)
    {
        $diffrentParameters = array();
        foreach ($parameters1 as $i => $parameter1) {
            if (!isset($parameters2[$i]) || $parameter1 != $parameters2[$i]) {
                $diffrentParameters[] = $parameter1;
            }
        }

        return $diffrentParameters;
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

        return;
    }
}
