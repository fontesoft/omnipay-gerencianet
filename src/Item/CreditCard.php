<?php

namespace Omnipay\Gerencianet\Item;

/**
 * Credit Card Payment Method
 *
 * @package Omnipay\Gerencianet\Base
 */
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

    /**
     * Get installments
     *
     * @return ?int
     */
    public function getInstallments()
    {
        return $this->getParameter('installments');
    }

    /**
     * Set the amount of installments
     *
     * @param int $value
     */
    public function setInstallments($value)
    {
        return $this->setParameter('installments', $value);
    }

    /**
     * Get Payment Token
     *
     * @return ?string
     */
    public function getPaymentToken()
    {
        return $this->getParameter('payment_token');
    }

    /**
     * Set Payment Token
     *
     * @param string $value
     */
    public function setPaymentToken($value)
    {
        return $this->setParameter('payment_token', $value);
    }

    /**
     * Get Billing Address
     *
     * @return ?mixed
     */
    public function getBillingAddress()
    {
        return $this->getParameter('billing_address');
    }

    /**
     * Set Billing Address
     *
     * @param mixed $value
     */
    public function setBillingAddress($value)
    {
        if (!$value instanceof Address) {
            $this->setParameter('billing_address', new Address($value));
        }
        $this->setParameter('billing_address', $value);
        
        return $this;
    }
}
