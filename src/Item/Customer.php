<?php
/**
 * Gerencianet Pagamento' Customer
 */

namespace Omnipay\Gerencianet\Item;

class Customer extends Base
{
    
    /**
     * Internal storage of all of the customer parameters.
     *
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameters;

    /**
     * Create a new Customer object using the specified parameters
     *
     * @param ?array $parameters An array of parameters to set on the new object
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }
    
    public function setName($value)
    {
        return $this->setParameter('name', $value);
    }

    public function setCpf($value)
    {
        return $this->setParameter('cpf', $value);
    }

    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    public function setPhoneNumber($value)
    {
        return $this->setParameter('phone_number', $value);
    }

    public function setBirth($value)
    {
        return $this->setParameter('birth', $value);
    }
    
    public function setJuridicalPerson($value)
    {
        if (!$value instanceof JuridicalPerson) {
            $this->setParameter('juridical_person', new JuridicalPerson($value));
        }
        $this->setParameter('juridical_person', $value);
        
        return $this;
    }
    
    public function setAddress($value)
    {
        if (!$value instanceof Address) {
            $this->setParameter('address', new Address($value));
        }
        $this->setParameter('address', $value);
        
        return $this;
    }
}
