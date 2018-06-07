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
    protected $parameters = [];

    /**
     * @param Parameter[]|array $parameters
     */
    public function __construct(array $parameters = [])
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
        $parameters = [];
        foreach ($this->parameters as $parameter) {
            $parameters[] = $parameter->toArray();
        }

        return [
            'parameters' => $parameters
        ];
    }

    /**
     * @param Parameter $parameter
     * @return void
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
