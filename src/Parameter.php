<?php

namespace Jobcloud\ClosureValidator;

class Parameter
{
    const classname = __CLASS__;

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
