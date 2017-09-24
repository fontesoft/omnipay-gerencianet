<?php

namespace Omnipay\Gerencianet;

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
        $this->billingAddress = new BillingAddress();
        $this->customer = new Customer();
        
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
}
