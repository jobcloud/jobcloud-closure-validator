<?php

namespace Jobcloud\ClosureValidator;

class Signature implements ToArrayInterface
{

    /**
     * @var string
     */
    const CLASS_NAME = __CLASS__;

    /**
     * @var Parameter[]|array
     */
    protected $parameters = array();

    /**
     * @param Parameter[]|array $parameters
     */
    public function __construct(array $parameters = array())
    {
        foreach ($parameters as $parameter) {
            $this->addParameter($parameter);
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $parameters = array();
        foreach ($this->parameters as $parameter) {
            $parameters[] = $parameter->toArray();
        }

        return array(
            'parameters' => $parameters
        );
    }

    /**
     * @param Parameter $parameter
     */
    protected function addParameter(Parameter $parameter)
    {
        $this->parameters[] = $parameter;
    }

    /**
     * @return array|Parameter[]
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}
