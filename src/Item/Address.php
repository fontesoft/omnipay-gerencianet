<?php

namespace Omnipay\Gerencianet\Item;

class Address extends Base
{
    /**
     * Internal storage of all parameters.
     *
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameters;
    
    /**
     * Create a new Address object using the specified parameters
     *
     * @param ?array $parameters An array of parameters to set on the new object
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * Set Street
     *
     * @param string $value
     */
    public function setStreet($value)
    {
        return $this->setParameter('street', $value);
    }

    /**
     * Set Number
     *
     * @param int $value
     */
    public function setNumber($value)
    {
        return $this->setParameter('number', $value);
    }

    /**
     * Set Neighborhood
     *
     * @param string $value
     */
    public function setNeighborhood($value)
    {
        return $this->setParameter('neighborhood', $value);
    }

    /**
     * Set Zipcode
     *
     * @param string $value
     */
    public function setZipcode($value)
    {
        return $this->setParameter('zipcode', $value);
    }

    /**
     * Set City
     *
     * @param string $value
     */
    public function setCity($value)
    {
        return $this->setParameter('city', $value);
    }

    /**
     * Set Complement
     *
     * @param string $value
     */
    public function setComplement($value)
    {
        return $this->setParameter('complement', $value);
    }

    /**
     * Set State/Province
     *
     * @param string $value
     */
    public function setState($value)
    {
        return $this->setParameter('state', $value);
    }
}
