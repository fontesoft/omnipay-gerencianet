<?php

namespace Omnipay\Gerencianet\Model;

use Omnipay\Gerencianet\Common\PaymentMethod;

class CreditCard extends PaymentMethod
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
            $this->setParameter('billing_address', new Address($value));
        }
        $this->setParameter('billing_address', $value);
        
        return $this;
    }
}
