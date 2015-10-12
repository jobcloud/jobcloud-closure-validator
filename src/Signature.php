<?php

namespace Jobcloud\ClosureValidator;

class Signature
{
    const classname = __CLASS__;

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
