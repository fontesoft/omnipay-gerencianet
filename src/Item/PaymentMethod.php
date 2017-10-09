<?php

namespace Omnipay\Gerencianet\Item;

class PaymentMethod extends Base
{
    const DISCOUNT_TYPE_CURRENCY = 'currency';
    const DISCOUNT_TYPE_PERCENTAGE = 'percentage';
    
    public function __construct($class, $parameters = null)
    {
        parent::__construct($class, $parameters);
    }
    
    public function setCustomer($value)
    {
        if (!$value instanceof Customer) {
            $this->setParameter('customer', new Customer($value));
        }
        $this->setParameter('customer', $value);
        
        return $this;
    }
    
    public function setDiscountType($value)
    {
        return $this->setParameter('discount_type', $value);
    }
    
    public function setDiscountValue($value)
    {
        return $this->setParameter('discount_value', $value);
    }
    
    public function setMessage($value)
    {
        return $this->setParameter('message', $value);
    }
}
