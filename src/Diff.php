<?php

namespace Jobcloud\ClosureValidator;

class Diff implements ToArrayInterface
{
    const classname = __CLASS__;

    /**
     * @var Parameter[]|array
     */
    protected $missingParameters = array();

    /**
     * @var Parameter[]|array
     */
    protected $additionalParameters = array();

    /**
     * @param Parameter[]|array $missingParameters
     * @param Parameter[]|array $additionalParameters
     */
    public function __construct(array $missingParameters = array(), array $additionalParameters = array())
    {
        foreach ($missingParameters as $missingParameter) {
            $this->addMissingParameter($missingParameter);
        }

        foreach ($additionalParameters as $additionalParameter) {
            $this->addAdditionalParameter($additionalParameter);
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'missingParameters' => $this->getParametersAsArray($this->missingParameters),
            'additionalParameters' => $this->getParametersAsArray($this->additionalParameters),
        );
    }

    /**
     * @param Parameter[]|array $parameters
     *
     * @return array
     */
    protected function getParametersAsArray(array $parameters)
    {
        $parametersAsArray = array();
        foreach ($parameters as $parameter) {
            $parametersAsArray[] = $parameter->toArray();
        }

        return $parametersAsArray;
    }

    /**
     * @param Parameter $parameter
     */
    protected function addMissingParameter(Parameter $parameter)
    {
        $this->missingParameters[] = $parameter;
    }

    /**
     * @param Parameter $parameter
     */
    protected function addAdditionalParameter(Parameter $parameter)
    {
        $this->additionalParameters[] = $parameter;
    }

    /**
     * @return Parameter[]|array
     */
    public function getMissingParameters()
    {
        return $this->missingParameters;
    }

    /**
     * @return Parameter[]|array
     */
    public function getAdditionalParameters()
    {
        return $this->additionalParameters;
    }

    /**
     * @return bool
     */
    public function isIdentical()
    {
        return count($this->missingParameters) === 0 && count($this->additionalParameters) === 0;
    }
}
