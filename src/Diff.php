<?php

namespace Jobcloud\ClosureValidator;

class Diff implements ToArrayInterface
{

    /**
     * @var string
     */
    const CLASS_NAME = __CLASS__;

    /**
     * @var Parameter[]|array
     */
    protected $missingParameters = [];

    /**
     * @var Parameter[]|array
     */
    protected $additionalParameters = [];

    /**
     * @param Parameter[]|array $missingParameters
     * @param Parameter[]|array $additionalParameters
     */
    public function __construct(array $missingParameters = [], array $additionalParameters = [])
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
        return [
            'missingParameters' => $this->getParametersAsArray($this->missingParameters),
            'additionalParameters' => $this->getParametersAsArray($this->additionalParameters)
        ];
    }

    /**
     * @param Parameter[]|array $parameters
     *
     * @return array
     */
    protected function getParametersAsArray(array $parameters)
    {
        $parametersAsArray = [];
        foreach ($parameters as $parameter) {
            $parametersAsArray[] = $parameter->toArray();
        }

        return $parametersAsArray;
    }

    /**
     * @param Parameter $parameter
     * @return void
     */
    protected function addMissingParameter(Parameter $parameter)
    {
        $this->missingParameters[] = $parameter;
    }

    /**
     * @param Parameter $parameter
     * @return void
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
     * @return boolean
     */
    public function isIdentical()
    {
        return count($this->missingParameters) === 0 && count($this->additionalParameters) === 0;
    }
}
