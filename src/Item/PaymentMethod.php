<?php

namespace Omnipay\Gerencianet\Item;

use Omnipay\Gerencianet\Item;

class PaymentMethod extends Item
{
    const DISCOUNT_TYPE_CURRENCY = 'currency';
    const DISCOUNT_TYPE_PERCENTAGE = 'percentage';
    
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
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
    
    public function getMessage()
    {
        return $this->getParameter('message');
    }
    
    public function setMessage($value)
    {
        return $this->setParameter('message', $value);
    }
}
