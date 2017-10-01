<?php

namespace Omnipay\Gerencianet\Model;

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
class BankingBillet extends PaymentMethod
{
    
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
    
    
    public function getExpireAt()
    {
        return $this->getParameter('expire_at');
    }
    
    public function setExpireAt($value)
    {
        return $this->setParameter('expire_at', $value);
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
