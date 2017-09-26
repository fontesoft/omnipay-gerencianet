<?php

namespace Omnipay\Gerencianet\Model;

use Symfony\Component\HttpFoundation\ParameterBag;
use Omnipay\Gerencianet\Common\Model;

class Address extends Model
{
    /**
     * Internal storage of all of the card parameters.
     *
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameters;
    
    /**
     * Create a new Customer object using the specified parameters
     *
     * @param array|null $parameters An array of parameters to set on the new object
     */
    public function __construct($parameters = null)
    {
        parent::__construct();
        $this->initialize($parameters);
    }
    
    /**
     * Initialize the Address object with parameters.
     *
     * If any unknown parameters passed, they will be ignored.
     *
     * @param array $parameters An associative array of parameters
     * @return Address provides a fluent interface.
     */
    public function initialize($parameters = null)
    {
        $this->parameters = new ParameterBag;

        $this->helper->initialize($this, $parameters);

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

    /**
     * Get one parameter.
     *
     * @return mixed A single parameter value.
     */
    protected function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    /**
     * Set one parameter.
     *
     * @param string $key Parameter key
     * @param mixed $value Parameter value
     * @return CreditCard provides a fluent interface.
     */
    protected function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);

        return $this;
    }
    
    public function getStreet()
    {
        return $this->getParameter('street');
    }
    
    public function setStreet($value)
    {
        return $this->setParameter('street', $value);
    }
    
    public function getNumber()
    {
        return $this->getParameter('number');
    }
    
    public function setNumber($value)
    {
        return $this->setParameter('number', $value);
    }
    
    public function getNeighborhood()
    {
        return $this->getParameter('neighborhood');
    }
    
    public function setNeighborhood($value)
    {
        return $this->setParameter('neighborhood', $value);
    }
    
    public function getZipcode()
    {
        return $this->getParameter('zipcode');
    }
    
    public function setZipcode($value)
    {
        return $this->setParameter('zipcode', $value);
    }
    
    public function getCity()
    {
        return $this->getParameter('city');
    }
    
    public function setCity($value)
    {
        return $this->setParameter('city', $value);
    }
    
    public function getComplement()
    {
        return $this->getParameter('complement');
    }
    
    public function setComplement($value)
    {
        return $this->setParameter('complement', $value);
    }
    
    public function getState()
    {
        return $this->getParameter('state');
    }
    
    public function setState($value)
    {
        return $this->setParameter('state', $value);
    }
}
