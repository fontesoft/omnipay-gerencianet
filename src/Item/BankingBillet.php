<?php

namespace Omnipay\Gerencianet\Item;

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

    /**
     * Set Expire at
     *
     * @param string $value Date format YYYY-MM-DD
     */
    public function setExpireAt($value)
    {
        return $this->setParameter('expire_at', $value);
    }

    /**
     * Set Fine
     *
     * @param int $value
     */
    public function setConfigurationFine($value)
    {
        return $this->setParameter('configuration_fine', $value);
    }

    /**
     * Set Interest Daily
     *
     * @param int $value
     */
    public function setConfigurationInterest($value)
    {
        return $this->setParameter('configuration_interest', $value);
    }
}
