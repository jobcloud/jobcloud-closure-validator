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
     * @param Signature $whishedSignature
     *
     * @return Diff
     */
    public function compare(Signature $givenSignature, Signature $whishedSignature)
    {
        $givenParameters = $givenSignature->getParameters();
        $whishedParameters = $whishedSignature->getParameters();

        $missingParameters = array();
        foreach ($whishedParameters as $i => $whishedParameter) {
            if (!isset($givenParameters[$i]) || $whishedParameter != $givenParameters[$i]) {
                $missingParameters[] = $whishedParameter;
            }
        }

        $additionalParameters = array();
        foreach ($givenParameters as $i => $givenParameter) {
            if (!isset($whishedParameters[$i]) || $givenParameter != $whishedParameters[$i]) {
                $additionalParameters[] = $givenParameter;
            }
        }

        return new Diff($missingParameters, $additionalParameters);
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
