<?php

namespace Omnipay\Gerencianet;

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
class BankingBillet extends Item
{
    
    const DISCOUNT_TYPE_CURRENCY = 'currency';
    const DISCOUNT_TYPE_PERCENTAGE = 'percentage';
    
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
        parent::__construct($this, $parameters);
    }
    
    /**
     * Get customer associated with the payment of the billet banking
     *
     * @return \Omnipay\Gerencianet\Customer Gerencianet Customer
     */
    public function getCustomer()
    {
        return $this->getParameter('customer');
    }

    /**
     * Set customer of the banking billet
     *
     * @param \Omnipay\Gerencianet\Customer $customer Gerencianet Customer
     */
    public function setCustomer($value)
    {
        if (!$value instanceof Customer) {
            $this->setParameter('customer', new Customer($value));
        }
        $this->setParameter('customer', $value);
        
        return $this;
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
        return $this->setParameter('discount_type', $value);
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
    
    public function getMessage()
    {
        return $this->getParameter('message');
    }
    
    public function setMessage($value)
    {
        return $this->setParameter('message', $value);
    }
}
