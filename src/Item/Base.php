<?php

namespace Omnipay\Gerencianet\Item;

use Symfony\Component\HttpFoundation\ParameterBag;
use Omnipay\Common\Helper;

class Base
{
    public $helper;
    
    public function __construct($class, $parameters = null)
    {
        $this->helper = new Helper();
        $this->initialize($class, $parameters);
    }
    
    /**
     * Initialize the object with parameters.
     *
     * If any unknown parameters passed, they will be ignored.
     *
     * @param array $parameters An associative array of parameters
     */
    public function initialize($class, $parameters)
    {
        $class->parameters = new ParameterBag;

        $this->helper->initialize($class, $parameters);

        return $this;
    }
    
    /**
     * Set one parameter.
     *
     * @param string $key Parameter key
     * @param mixed $value Parameter value
     */
    protected function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);

        return $this;
    }
    
    /**
     * Get all parameters.
     *
     * @return array An associative array of parameters.
     */
    public function getParameters()
    {
        return $this->parameters->all();
    }
}
