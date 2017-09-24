<?php

namespace Omnipay\Gerencianet;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Banking Billet class
 * 
 * This class defines and abstracts all of the banking billet types used
 * throughout the Omnipay system.
 * 
 * The full list of banking billet attributes that may be set via the parameter to
 * *new* is as follows:
 * 
 * * expire_at
 */
class BankingBillet
{
    private $customer;
    
    /**
     * Internal storage of all of the banking billet parameters.
     *
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameters;
    
    /**
     * Create a new BankingBillet object using the specified parameters 
     *
     * @param array|null $parameters An array of parameters to set on the new object
     */
    public function __construct($parameters = null)
    {
        $this->initialize($parameters);
    }
    
    /**
     * Initialize the object with parameters.
     *
     * If any unknown parameters passed, they will be ignored.
     *
     * @param array $parameters An associative array of parameters
     * @return BankingBillet provides a fluent interface.
     */
    public function initialize($parameters)
    {
        $this->parameters = new ParameterBag;

        Helper::initialize($this, $parameters);

        return $this;
    }
    
    /**
     * Set one parameter.
     *
     * @param string $key Parameter key
     * @param mixed $value Parameter value
     * @return BankingBillet provides a fluent interface.
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

    /**
     * Get one parameter.
     *
     * @return mixed A single parameter value.
     */
    protected function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    public function getExpireAt()
    {
        return $this->getParameter('expire_at');
    }

    /**
     * Get customer associated with the payment of the billet banking
     * 
     * @return \Omnipay\Gerencianet\Customer Gerencianet Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    public function setExpireAt($value)
    {
        return $this->setParameter('expire_at', $value);
    }

    /**
     * Set customer of the banking billet
     * 
     * @param \Omnipay\Gerencianet\Customer $customer Gerencianet Customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

}
