<?php

namespace Omnipay\Gerencianet;

use Symfony\Component\HttpFoundation\ParameterBag;
use Omnipay\Common\Helper;

class CreditCard
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
        $this->initialize($parameters);
    }
    
    /**
     * Initialize the object with parameters.
     *
     * If any unknown parameters passed, they will be ignored.
     *
     * @param array $parameters An associative array of parameters
     * @return CreditCard provides a fluent interface.
     */
    public function initialize($parameters = null)
    {
        $this->parameters = new ParameterBag;

        Helper::initialize($this, $parameters);
        
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

    public function setCustomer($customer)
    {
        if (!$value instanceof Customer) {
            $this->setParameter('customer', new Customer($value));
        }
        $this->setParameter('customer', $value);
        
        return $this;
    }
}
