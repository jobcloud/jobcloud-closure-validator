<?php

namespace Jobcloud\ClosureValidator;

class Parameter implements ToArrayInterface
{

    /**
     * @var string
     */
    const CLASS_NAME = __CLASS__;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $type;

    /**
     * @param string      $name
     * @param string|null $type
     */
    public function __construct($name, $type = null)
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'name' => $this->getName(),
            'type' => $this->getType()
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }
}
