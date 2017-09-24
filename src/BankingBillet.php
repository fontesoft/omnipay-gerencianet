<?php

namespace Omnipay\Gerencianet;

use Symfony\Component\HttpFoundation\ParameterBag;
use Omnipay\Common\Helper;

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
    
    const DISCOUNT_TYPE_CURRENCY = 'currency';
    const DISCOUNT_TYPE_PERCENTAGE = 'percentage';
    
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
    public function __construct($parameters = null, $customer = null)
    {
        if($customer instanceof Customer) {
            $this->customer = $customer;
        } else {
            $this->customer = new Customer($customer);
        }
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
        $parameters = $this->parameters->all();
        if($this->customer->getParameters()) {
            $parameters['customer'] = $this->customer->getParameters();
        }
        
        return $parameters;
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
     * Get customer associated with the payment of the billet banking
     * 
     * @return \Omnipay\Gerencianet\Customer Gerencianet Customer
     */
    public function getCustomer()
    {
        return $this->customer;
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
    
    public function getExpireAt()
    {
        return $this->getParameter('expire_at');
    }
    
    public function setExpireAt($value)
    {
        return $this->setParameter('expire_at', $value);
    }
    
    public function getDiscountType()
    {
        return $this->getParameter('discount_type');
    }
    
    public function setDiscountType($value)
    {
        return $this->setParameter('discount_value', $value);
    }
    
    public function getDiscountValue()
    {
        return $this->getParameter('discount_value');
    }
    
    public function setDiscountValue($value)
    {
        return $this->setParameter('discount_value', $value);
    }

    public function getConfigurationFine()
    {
        return $this->getParameter('configuration_fine');
    }
    
    public function setConfigurationFine($value)
    {
        return $this->setParameter('configuration_fine', $value);
    }
    
    public function getConfigurationInterest()
    {
        return $this->getParameter('configuration_interest');
    }
    
    public function setConfigurationInterest($value)
    {
        return $this->setParameter('configuration_interest', $value);
    }
}
