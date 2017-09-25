<?php

namespace Omnipay\Gerencianet;

class CreditCard extends Item
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
    
    public function getInstallments()
    {
        return $this->getParameter('installments');
    }
    
    public function setInstallments($value)
    {
        return $this->setParameter('installments', $value);
    }
    
    public function getPaymentToken()
    {
        return $this->getParameter('payment_token');
    }
    
    public function setPaymentToken($value)
    {
        return $this->setParameter('payment_token', $value);
    }
    
    public function getBillingAddress()
    {
        return $this->getParameter('billing_address');
    }
    
    public function setBillingAddress($value)
    {
        if (!$value instanceof Address) {
            $this->setParameter('address', new Address($value));
        }
        $this->setParameter('address', $value);
        
        return $this;
    }
    
    public function getCustomer()
    {
        return $this->getParameter('customer');
    }

    public function setCustomer($value)
    {
        if (!$value instanceof Customer) {
            $this->setParameter('customer', new Customer($value));
        }
        $this->setParameter('customer', $value);
        
        return $this;
    }
}
