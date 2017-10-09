<?php

namespace Omnipay\Gerencianet\Item;

class JuridicalPerson extends Base
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
    
    public function setCorporateName($value)
    {
        return $this->setParameter('corporate_name', $value);
    }
    
    public function setCnpj($value)
    {
        return $this->setParameter('cnpj', $value);
    }
}
