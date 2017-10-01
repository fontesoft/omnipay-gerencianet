<?php

namespace Omnipay\Gerencianet\Item;

use Symfony\Component\HttpFoundation\ParameterBag;
use Omnipay\Gerencianet\Item;

class Address extends Item
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
        parent::__construct($this, $parameters);
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
