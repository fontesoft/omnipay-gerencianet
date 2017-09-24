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
    
    private $billingAddress;
    
    private $customer;
    
    /**
     * Create a new Customer object using the specified parameters
     *
     * @param array|null $parameters An array of parameters to set on the new object
     */
    public function __construct($parameters = null, $address = null, $customer = null)
    {
        $this->billingAddress = new Address($address);
        $this->customer = new Customer($customer);
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
        $parameters = $this->parameters->all();
        $parameters['billing_address'] = $this->billingAddress->getParameters();
        $parameters['customer'] = $this->customer->getParameters();
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
        return $this->billingAddress;
    }
    
    public function setBillingAddress($address)
    {
        $this->billingAddress = $address;
        
        return $this;
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
}
